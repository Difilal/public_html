pipeline {
    agent any

    environment {
        SONAR_HOST = "http://192.168.1.30:9000"
        SERVER = "192.168.1.15"
        USER = "cp"
        TARGET = "/home/web.serverfilal.site/public_html"
    }

    stages {
        stage('Clone Repository') {
            steps {
                git branch: 'main', url: 'https://github.com/Difilal/public_html.git'
            }
        }

        stage('Install PHP Dependencies') {
            steps {
                sh 'composer install --no-interaction --prefer-dist'
            }
        }

        stage('Install') {
            steps {
                sh 'npm install'
            }
        }

        stage('PHP Unit Test') {
            steps {
                sh 'vendor/bin/phpunit --configuration phpunit.xml'
            }
            post {
                always {
                    junit allowEmptyResults: true, testResults: 'test-results/phpunit/junit.xml'
                    archiveArtifacts allowEmptyArchive: true, artifacts: 'test-results/phpunit/**'
                }
            }
        }

        stage('Unit Test') {
            steps {
                sh 'npm run test:ci'
            }
            post {
                always {
                    junit allowEmptyResults: true, testResults: 'test-results/jest-junit.xml'
                    archiveArtifacts allowEmptyArchive: true, artifacts: 'coverage/**, test-results/**'
                }
            }
        }

        stage('SonarQube Analysis') {
            steps {
                withCredentials([string(credentialsId: 'sonar-token', variable: 'SONAR_TOKEN')]) {
                    sh '''
                    /opt/sonar-scanner/bin/sonar-scanner \
                    -Dsonar.projectKey=php-app \
                    -Dsonar.sources=. \
                    -Dsonar.tests=tests \
                    -Dsonar.test.inclusions=tests/**/*.test.js \
                    -Dsonar.exclusions=coverage/**,node_modules/**,node_modules.zip,**/*.min.js,**/*.map,**/*.sql,images/**,img/**,asset/**,thumb/**,!log-file-*/**,RecycleBin~b00a.ffs_tmp/** \
                    -Dsonar.javascript.lcov.reportPaths=coverage/lcov.info \
                    -Dsonar.junit.reportPaths=test-results/jest-junit.xml \
                    -Dsonar.host.url=$SONAR_HOST \
                    -Dsonar.token=$SONAR_TOKEN
                    '''
                }
            }
        }

        stage('Deploy to Server') {
            steps {
                sshagent(['server-ssh']) {
                    sh '''
                    rsync -avz --delete \
                    --exclude ".git/" \
                    --exclude "node_modules/" \
                    --exclude "coverage/" \
                    --exclude "test-results/" \
                    ./ $USER@$SERVER:$TARGET
                    '''
                }
            }
        }
    }
}
