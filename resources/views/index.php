<?php include('includes/header.php'); ?>

<nav>
  <div class="nav-wrapper blue">
  <a href="/" class="brand-logo center">Eduzz Candidatos</a>
  </div>
</nav>

<main class="container">
  <div class="row">
    <p class="no-results <?= count($candidates) > 0 ? 'hide' : '' ?>">Parece que ainda não há candidatos cadastrados :(</p>
    <?php foreach($candidates as $candidate): ?>
      <div class="card sticky-action col s12 m6">
        <div class="card-image blue">
          <img src="<?= $candidate->avatar ?: '/assets/avatars/default.png' ?>" class="responsive-img">
        </div>
        <div class="card-content">
          <span class="card-title"><?= "{$candidate->firstname} {$candidate->lastname}" ?></span>
          <strong><?= $candidate->role ?></strong>
          <p><strong>E-mail:</strong> <?= $candidate->email ?></p>
          <p><a href="<?= $candidate->linkedin ?>">Perfil no LinkedIn</a></p>
        </div>
        <div class="card-action">
          <a class="waves-effect waves-light btn red delete" data-id="<?= $candidate->id ?>">Excluir</a>
          <a href="/candidate/<?= $candidate->id ?>" class="waves-effect waves-light btn blue">Alterar</a>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</main>

<div class="fixed-action-btn">
  <a id="menu" class="btn-floating btn-large blue"><i class="large material-icons">menu</i></a>
  <ul>
    <li>
      <a href="/candidate" class="btn-floating green" title="Adicionar novo candidato"><i class="material-icons">add</i></a>
    </li>
  </ul>
</div>

<div class="tap-target blue lighten-4" data-activates="menu">
  <div class="tap-target-content">
    <h5>Ações</h5>
    <p>Através deste botão, você poderá realizar ações, tal como cadastrar novos candidatos.</p>
  </div>
</div>

<?php include('includes/footer.php'); ?>