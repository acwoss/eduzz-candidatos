<?php include('includes/header.php'); ?>

<nav>
    <div class="nav-wrapper blue">
        <a href="/" class="brand-logo center">Eduzz</a>
        <ul id="nav-mobile" class="left">
            <li><a href="/"><i class="material-icons">arrow_back</i></a></li>
        </ul>
    </div>
</nav>

<div class="container">
    <div class="row">
        <form class="col s12" method="post" action="/candidate/<?= $candidate->id ?: '' ?>" enctype="multipart/form-data">
            <div class="row">
                <div class="input-field col s6">
                    <input 
                        id="firstname"
                        type="text"
                        name="firstname" 
                        placeholder="Ex.: John" 
                        value="<?= $candidate->firstname ?>"
                        class="validate" 
                        required
                    >
                    <label for="firstname">Nome</label>
                </div>
                <div class="input-field col s6">
                    <input 
                        if="lastname"
                        type="text"
                        name="lastname"
                        placeholder="Ex.: Doe"
                        value="<?= $candidate->lastname ?>"
                        class="validate"
                        required
                    >
                    <label for="lastname">Sobrenome</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6">
                    <input 
                        id="email"
                        type="email"
                        name="email"
                        placeholder="Ex.: john@doe.com" 
                        value="<?= $candidate->email ?>"
                        class="validate" 
                        required
                    >
                    <label for="email">E-mail</label>
                </div>
                <div class="input-field col s6">
                    <input
                        id="role"
                        type="text"
                        name="role"
                        placeholder="Ex.: Desenvolvedor PHP" 
                        value="<?= $candidate->role ?>"
                        class="validate" 
                        required
                    >
                    <label for="role">Cargo</label>
                </div>
            </div>
            <div class="file-field input-field">
                <div class="btn">
                    <span>Foto</span>
                    <input
                        id="avatar"
                        type="file" 
                        name="avatar"
                    >
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text">
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input 
                        id="linkedin"
                        type="url"
                        name="linkedin"
                        placeholder="Ex.: https://www.linkedin.com/in/santa-claus" 
                        value="<?= $candidate->linkedin ?>"
                        class="validate" 
                        required
                    >
                    <label for="curriculum">Perfil no LinkedIn</label>
                </div>
            </div>
            <div class="row">
                <button class="col s12 m4 l2 btn waves-effect waves-light" type="submit" name="action">
                    Enviar<i class="material-icons right">send</i>
                </button>
            </div>
        </form>
    </div>
</div>

<?php include('includes/footer.php'); ?>