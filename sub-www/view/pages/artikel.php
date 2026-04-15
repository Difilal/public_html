<?php include('header-artikel.php');?>

<div class="section sec-testimonials" id="main-artikel">
  <div class="container">
    <?php include('main-artikel.php');?>
  </div>
</div>

<script>
  const defaultTitle = "PMPLand";
  const deafultMetaDescription = "PMPLand, PT. Panca Mulia Persada, perusahaan pengembang perumahan subsidi dan komersil, terbaik dan terbesar sewilayah 3 Cirebon.";
  const defaultMetaKeyword = "pmpland, perumahan subsidi, perumahan, proyek perumahan, perumahan cirebon, perumahan murah";
  
  function updateTitle(newTitle, isDefault = true){
    if(!isDefault){
      document.title = defaultTitle + " - " + newTitle;
    }else{
      document.title = defaultTitle;
    }
  }

  function updateMeta(name, content) {
      let metaTag = document.querySelector(`meta[name="${name}"]`);
      
      if (metaTag) {
        metaTag.setAttribute("content", content);
      } else {
        metaTag = document.createElement("meta");
        metaTag.setAttribute("name", name);
        metaTag.setAttribute("content", content);
        document.head.appendChild(metaTag);
      }
  }

  document.addEventListener("DOMContentLoaded", function() {
    const judulArtikel = <?= json_encode($data["judul_artikel"] ?? "")?>;
    const metaKeyword = <?= json_encode($data["meta_keyword"] ?? "")?>;
    const metaDescription = <?= json_encode($data["meta_description"] ?? "")?>;
    const isArtikelAvailable = <?= json_encode(!empty($data)); ?>;
    
    if (isArtikelAvailable) {
      updateTitle(judulArtikel, false);
      updateMeta("description", deafultMetaDescription + " - " +metaDescription);
      updateMeta("keywords", defaultMetaKeyword + " - " + metaKeyword);
    }else{
      updateTitle(defaultTitle, true);
      updateMeta("description", deafultMetaDescription);
      updateMeta("keywords", defaultMetaKeyword);
    }
  });
</script>

<script src="<?php echo siteUrl();?>sub-www/js/js-global-auth/commonJS.js?v=<?= time() ?>"></script>
<script>
gtag('event', 'view_article', {
    article_id: '<?= $artikel_id ?>',
    article_title: '<?= addslashes($artikel_judul) ?>',
    article_slug: '<?= $artikel_slug ?>'
});
</script> 
