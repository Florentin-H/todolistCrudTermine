function deleteRecord(id) {
        if (confirm("Êtes-vous sûr de vouloir supprimer cet enregistrement ?")) {
            // Redirigez vers le script de suppression avec l'ID de l'enregistrement
            window.location.href = 'delete.php?id=' + id;
        }
    }
function confirmDeleteAll() {
        if (confirm("Êtes-vous sûr de vouloir supprimer tous les enregistrements ?")) {
            document.getElementById('deleteAllForm').action = 'delete-all.php';
            document.getElementById('deleteAllForm').submit();
        }
    }



