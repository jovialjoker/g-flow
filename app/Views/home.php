<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>G-flow</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
    <link rel="stylesheet" href="https://unpkg.com/@bootstrapstudio/bootstrap-better-nav/dist/bootstrap-better-nav.min.css">
    <link rel="stylesheet" href="/css/styles.css">
</head>

<body>
    <section class="d-flex flex-column justify-content-between" id="hero">
        <div id="hero-top">
            <nav class="navbar navbar-light navbar-expand-md">
                <div class="container-fluid"><a class="navbar-brand" href="#"></a><button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                    <div class="collapse navbar-collapse"
                        id="navcol-1">
                        <ul class="nav navbar-nav mx-auto">
                            <li class="nav-item" role="presentation"><a class="nav-link active" href="#"><?= lang('app.overview', [], session('language')); ?></a></li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" href="<?= route_to('language'); ?>"><?= lang('app.lang_switch', [], session('language')); ?></a>

                            </li>
                        </ul>
                        <ul class="nav navbar-nav">
                        <?php if(is_null(session()->get('logged_in'))): ?>
                            <li class="nav-item" role="presentation"><a class="nav-link active" href="/login"><?= lang('app.gitlog', [], session('language')); ?><i class="ion-social-github"></i></a></li>
                        <?php else: ?>
                            <li class="nav-item" role="presentation"><a class="nav-link active" href="/dashboard"><?= lang('app.home', [], session('language')); ?></a></li>
                            <li class="nav-item" role="presentation"><a class="nav-link active" href="/logout"><?= lang('app.logout', [], session('language')); ?></a></li>
                        <?php endif ?>
                        </ul>
                    </div>
                </div>
            </nav>
            <h1 class="text-center" id="title">(G)Flow</h1>
            <h2 class="text-center" id="subtitle" style="font-family:Montserrat, sans-serif;">Productivity</h2>
        </div>
        <div id="hero-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-8 offset-2">
                        <p><?= lang('app.homesh', [], session('language')); ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <p id="p-top"><?= lang('app.simplicity', [], session('language')); ?></p>
                        <p id="p-bot"><?= lang('app.simplicityt', [], session('language')); ?></p>
                    </div>
                    <div class="col white-border">
                        <p id="p-top"><?= lang('app.dev', [], session('language')); ?></p>
                        <p id="p-bot"><?= lang('app.devt', [], session('language')); ?></p>
                    </div>
                    <div class="col">
                        <p id="p-top"><?= lang('app.tools', [], session('language')); ?></p>
                        <p id="p-bot"><?= lang('app.toolst', [], session('language')); ?></p>
                    </div>
                    <?php if(is_null(session()->get('logged_in'))): ?>
                    <div class="col align-self-center"><button class="btn btn-primary btn-block register-button" type="button" href="/login"><?= lang('app.logint', [], session('language')); ?></button></div>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/@bootstrapstudio/bootstrap-better-nav/dist/bootstrap-better-nav.min.js"></script>
</body>

</html>