<?php include(ROOT.'/layout/header.php');?>
    <div class="main">
        <p class="text-left"><span id="tasks" class="glyphicon glyphicon-bookmark"></span> <span id="exit" class="glyphicon glyphicon-share-alt"></span></p>
        <div id="registration-form">
            <p class="text-right"><span id="exitreg" class="glyphicon glyphicon-remove"></span></p>
        </div>
        <div id="form-r">
            <input id="hid" type="hidden" value="<?php echo $user_id ?>">
            <h1>Регистрация</h1>
            <p id="success" class="bg-success"></p>
            <form role="form">
                <div class="form-group-sm">
                    <label for="username">Username</label>
                    <input id="username" type="text" class="form-control" value="" placeholder="Username">
                    <p id="nameerr" class="text-danger error"></p>
                </div>
                <div class="form-group-sm">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control" placeholder="email">
                    <p id="emailerr" class="text-danger error"></p>
                </div>
                <div class="form-group-sm">
                    <label for="password">Password</label>
                    <input id="password" type="password" class="form-control" placeholder="password">
                    <p id="passworderr" class="text-danger error"></p>
                </div>
                <button id="btn-register" type="button" name="submit" class="btn btn-success btn-sm">Регистрация</button>
            </form>
        </div>
        <div id="autorization-form">
            <p class="text-right"><span id="exitauto" class="glyphicon glyphicon-remove"></span></p>
        </div>
        <div id="form-a">
            <h1>Авторизация</h1>
            <p id="autoerror" class="text-danger error"></p>
            <form role="form" action="/autorization">
                <div class="form-group-sm">
                    <label for="email">Email</label>
                    <input id="email-a" name="email" type="email" class="form-control" placeholder="email">
                </div>
                <div class="form-group-sm">
                    <label for="password">Password</label>
                    <input id="password-a" name="password" type="password" class="form-control" placeholder="password">
                </div>
                <br>
                <button id="btn-autorization" type="button" name="submit" class="btn btn-primary btn-sm">Вход</button>
            </form>
        </div>
        <div class="conteiner-fluid">
            <div class="add">
                <p class="user">Добрый день, <span id="user"><strong><?php echo $user_name ?></strong></span>!</p>
                <br>

                <form action="/beejee/addtask" method="post">
                    <?php if($check==1): ?>
                        <button id="btn-task" type="submit" class="btn btn-default <?php echo 'disabled' ?>">Добавить задачу</button>
                        <?php else: ?>
                            <button id="btn-task" type="submit" class="btn btn-default">Добавить задачу</button>
                            <?php endif; ?>
                </form>

                <div class="autorization">
                    <a id="auto">Авторизация</a>
                    <span>&#160;/&#160;</span>
                    <a id="reg">Регистрация</a>
                </div>
            </div>
        </div>
    </div>
    <?php include(ROOT.'/layout/footer.php');?>