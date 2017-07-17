<?php include(ROOT.'/layout/header.php');?>
    <div class="task-list">
        <div class="conteiner">
            <div class="row">
                <div class="col-sm-4">
                    <div id="list">
                        <form role="form">
                            <div class="form-group-sm">
                                <label for="search">Поиск задач</label>
                                <div class="input-group">
                                    <input id="search" type="text" class="form-control" placeholder="search">
                                    <span class="input-group-addon">
<span class="glyphicon glyphicon-search"></span>
                                    </span>
                                </div>
                                <label class="btn btn-info btn-xs">
                                    <input type="checkbox" id="check"> Выполнение задачи
                                </label>
                            </div>
                        </form>
                        <br>
                    </div>
                </div>
                <div id="s-task" class="col-sm-8">
                    <?php foreach($arr as $key=>$value): ?>
                        <div class="one">
                            <div class="col-sm-3"><img src="<?php echo $value["path"]; ?>" alt="нет изображения"></div>
                            <div class="col-sm-8">
                                <div class="user"><small class="text-muted"><?php echo $value["name"]; ?></small></div>
                                <div class="text">
                                    <?php echo $value["tasks"]; ?>
                                </div>
                            </div>
                            <?php if($value["status"]==1): ?>
                                <div class="col-sm-1">
                                    <input type="checkbox" checked disabled>
                                </div>
                                <?php else: ?>
                                    <div class="col-sm-1">
                                        <input type="checkbox" disabled>
                                    </div>
                                    <?php endif; ?>
                                        <br>
                                        <br>
                                        <div class=" col-sm-12">
                                            <hr>
                                        </div>
                        </div>
                        <?php endforeach; ?>
                            <div class="col-sm-offset-4 col-sm-8">
                                <ul class="pagination">
                                    <li><a href="/beejee/alltask?page=1">«</a></li>
                                    <?php for($i=1;$i<=$countPage;$i++): ?>
                                        <li>
                                            <a href="/beejee/alltask?page=<?php echo $i ?>">
                                                <?php echo $i ?>
                                            </a>
                                        </li>
                                        <?php endfor; ?>
                                            <li><a href="/beejee/alltask?page=<?php echo $countPage ?>">»</a></li>
                                </ul>
                            </div>
                </div>
            </div>
        </div>
        <?php include(ROOT.'/layout/footer.php');?>