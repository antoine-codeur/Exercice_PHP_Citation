document.getElementById('Gen_Button').addEventListener('click', function() {
    var nombreCitations = document.getElementById('nombreCitations').value;
    
    fetch('index.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `generate=1&nombreCitations=${nombreCitations}`
    })
    .then(response => response.text())
    .then(html => {
        var parser = new DOMParser();
        var doc = parser.parseFromString(html, 'text/html');
        var citationContentContainer = doc.getElementById('citation_result');
        if (citationContentContainer) {
            document.getElementById('citation_result').innerHTML = citationContentContainer.innerHTML;
        } else {
            console.error('Element #citation_result not found in the response.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
});
