<?php
// Conexão com o banco de dados
require_once 'functions/db.inc.php';

// Função para recuperar os três últimos documentos
function getLastThreeDocuments(object $pdo) {
    $sql = "SELECT * FROM document ORDER BY PublicationDate DESC LIMIT 3";
    $stmt = $pdo->query($sql);
    return $stmt->fetchAll();
}

$documents = getLastThreeDocuments($pdo);
?>

<html>
<div class="container">
    <div class="p-5 my-4 bg-light rounded-3">
        <h1>Repositório de conteúdos da licenciatura em TIWM </h1>
        <p class="lead">O objetivo do <b>Repositório de conteúdos da licenciatura em TIWM </b>(Instituto Politécnico da Maia) é disponibilizar aos docentes uma ferramenta colaborativa onde podem ser colocados trabalhos (enunciados) as suas correções ou simplesmente enunciados de forma a construir um portfólio do curso. 
 		Podem ser disponibilizados trabalhos realizados por alunos que tenham interesse para a UC em causa por serem exemplos de boas práticas ou más práticas.</p>
    </div>
    <div class="row g-3">
        <div class="col">
		<div id="documentCarousel" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        <?php foreach ($documents as $index => $document): ?>
            <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                <div class="d-flex justify-content-center align-items-center" style="height: 350px; background-color: #f8f9fa;">
                    <div class="text-center">
                        <h5><?= htmlspecialchars($document['DocumentTitle']) ?></h5>
                        <p><?= htmlspecialchars($document['DocumentSummary']) ?></p>
						<p><?= htmlspecialchars($document['PublicationDate']) ?></p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    		<a class="carousel-control-prev text-dark" href="#documentCarousel" role="button" data-slide="prev">
        		<span class="carousel-control-prev-icon" aria-hidden="true"></span>
        		<span class="sr-only">Previous</span>
    		</a>
    		<a class="carousel-control-next text-dark" href="#documentCarousel" role="button" data-slide="next">
        		<span class="carousel-control-next-icon" aria-hidden="true"></span>
        		<span class="sr-only">Next</span>
    		</a>
		</div>
		<!-- Inclua o JS do Bootstrap e o jQuery -->
		<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        </div>
        <div class="col-md-6 col-lg-4 col-xl-3">
            <h2>Area Privada</h2>
            <p>Ainda em desenvovimento, deverá estár presente uma pequena descrição sobre Area privada da UMAIA e a imagem servira como link para reencaminhar o utilizador para o respetivo login, na area de aluno.</p>
			<img class="img-responsive" src="assets/images/logo_ismai.png" alt="Repositório TIWM">
        </div>
        <div class="col-md-6 col-lg-4 col-xl-3">
            <h2>Email</h2>
            <p>Ainda em desenvovimento, deverá estár presente uma pequena descrição sobre Area privada da UMAIA e a imagem servira como link para reencaminhar o utilizador para o respetivo email de aluno, na area de aluno.</p>
			<img class="img-responsive" src="assets/images/logo_ipmaia.png" alt="Repositório TIWM">
        </div>
	</div>
</div>
</html>