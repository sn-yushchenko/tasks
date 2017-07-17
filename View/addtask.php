<?php include(ROOT.'/layout/header.php');?>
    <div class="addtask col-sm-12">
        <div id="form-task" class="col-sm-offset-2 col-sm-10 col-xs-5">
            <div id="block1">
                <form id="bodytask" role="form" class="clearfix">
                    <h1>Опишите задачу</h1>
                    <div class="form-group-sm">
                        <label for="name" class="control-label col-sm-2">Имя</label>
                        <div class="col-sm-10">
                            <p id="name" class="form-control-static">
                                <?php echo $name ?>
                            </p>
                        </div>
                    </div>
                    <br/>
                    <br/>
                    <div class="form-group-sm">
                        <label for="email" class="control-label col-sm-2">Email</label>
                        <div class="col-sm-10">
                            <p id="email" class="form-control-static">
                                <?php echo $email ?>
                            </p>
                        </div>
                    </div>
                    <br/>
                    <br/>
                    <div class="form-group-sm">
                        <label for="task" class="control-label col-sm-2">Задача</label>
                        <div class="col-sm-10">
                            <textarea id="textarea" name="textarea" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="form-group-sm">
                        <label for="file" class="control-label col-sm-2">Фото</label>
                        <div class="col-sm-10">
                            <input type="file" id="file" name="photo" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="button" id="btn-preview" class="btn btn-primary btn-sm">Предварительный просмотр</button>
                        <button id="add-preview" type="button" class="btn btn-success btn-sm">Добавить</button>
                    </div>
                </form>
            </div>
            <div id="preview" class="clearfix">
                <p class="text-right"><span id="exitpreview" class="glyphicon glyphicon-share"></span></p>
                <div class="col-sm-3"><img id="imgpreview" alt="нет изображения"></div>
                <div class="col-sm-8">
                    <div class="user"><small class="text-muted"><?php echo $name ?></small></div>
                    <div id="preview-task" class="text"></div>
                </div>
                <div class="col-sm-1">
                    <input type="checkbox" disabled>
                </div>
                <br>
                <br>
                <div class=" col-sm-12">
                    <hr>
                </div>
                <button id="add" type="button" class="btn btn-success btn-sm btn-block">Добавить</button>
            </div>
        </div>

    </div>
    <?php include(ROOT.'/layout/footer.php');?>