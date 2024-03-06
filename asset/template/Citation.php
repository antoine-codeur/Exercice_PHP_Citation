<div class="citation_pagin">
    <p><?php echo htmlspecialchars($item['citation']); ?></p>
    <p><em><?php echo htmlspecialchars($item['auteur']); ?></em></p>
    <a href="src/download.php?citation=<?php echo urlencode($item['citation']); ?>" class="download-link">Télécharger en PNG</a>
</div>

