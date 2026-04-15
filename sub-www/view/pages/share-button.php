<style>
.btn-share-artikel {
    color: #fff;
    border: none;
    padding: 8px 12px;
    border-radius: 5px;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 6px;
    cursor: pointer;
    transition: background 0.3s;
    width: 100%; /* Make button fill its column */
    justify-content: center;
}

.btn-share-artikel.linkedin { background-color: #0077B5; }
.btn-share-artikel.facebook { background-color: #1877F2; }
.btn-share-artikel.twitter { background-color: #1DA1F2; }
.btn-share-artikel.whatsapp { background-color: #25D366; }
.btn-share-artikel.telegram { background-color: #0088cc; }
.btn-share-artikel.copy { background-color: #6c757d; } /* Gray for copy link */

.btn-share-artikel:hover {
    opacity: 0.85;
}
</style>

<div class="share-label mt-5"><h5>Bagikan:</h5></div>

<div class="section-share-article text-right">
    <div class="row g-2">
        <div class="col-12 col-sm-6 col-md-4 col-lg-2">
            <button class="btn-share-artikel linkedin" to="linkedin" title="<?= $data["judul_artikel"] ?>">
                <i class="fab fa-linkedin"></i> LinkedIn
            </button>
        </div>
        <div class="col-12 col-sm-6 col-md-4 col-lg-2">
            <button class="btn-share-artikel facebook" to="facebook" title="<?= $data["judul_artikel"] ?>">
                <i class="fab fa-facebook"></i> Facebook
            </button>
        </div>
        <div class="col-12 col-sm-6 col-md-4 col-lg-2">
            <button class="btn-share-artikel twitter" to="twitter" title="<?= $data["judul_artikel"] ?>">
                <i class="fab fa-twitter"></i> Twitter
            </button>
        </div>
        <div class="col-12 col-sm-6 col-md-4 col-lg-2">
            <button class="btn-share-artikel whatsapp" to="whatsapp" title="<?= $data["judul_artikel"] ?>">
                <i class="fab fa-whatsapp"></i> WhatsApp
            </button>
        </div>
        <div class="col-12 col-sm-6 col-md-4 col-lg-2">
            <button class="btn-share-artikel telegram" to="telegram" title="<?= $data["judul_artikel"] ?>">
                <i class="fab fa-telegram"></i> Telegram
            </button>
        </div>
        <div class="col-12 col-sm-6 col-md-4 col-lg-2">
            <button class="btn-share-artikel copy" to="copy" title="<?= $data["judul_artikel"] ?>">
                <i class="fas fa-link"></i> Copy
            </button>
        </div>
    </div>
</div>
