<?php include(ROOT.'/layout/header.php');?>
<div class="admin">
        <h1>Список задач</h1>
        <div class="text-center table-responsive" id="table-task">
            <table class="table table-bordered table-hover">
                
                <thead>
                    <tr class="active">
                        <th class="text-center">Картинка</th>
                        <th class="text-center">Имя пользователя</th>
                        <th class="text-center">Е-mail</th>
                        <th class="text-center">Тело задачи</th>
                        <th class="text-center">Редактировать</th>
                        <th class="text-center">Статус</th>
                    </tr>
                </thead>
                <tbody>
                   <?php foreach($arr as $key=>$value): ?>
                    <tr>
                        <td class="text-center" class="text-center"><img class="img-table" src="<?php echo $value['path']; ?>" alt="нет изображения"></td>
                        <td class="text-center"><?php echo $value['name']; ?></td>
                        <td class="text-center"><?php echo $value['email']; ?></td>
                        <td class="text-center"><textarea  id="<?php echo $value['id']; ?>a" class="form-control" ><?php echo $value['tasks']; ?></textarea></td>
                        <?php if($value['status']==1): ?>
                        <td class="text-center"><input class="change" type="checkbox" id="<?php echo $value['id']; ?>c" checked></td>
                        <?php else:?>
                        <td class="text-center"><input class="change" type="checkbox" id="<?php echo $value['id']; ?>c"></td>
                        <?php endif; ?>
                        <td class="text-center"><button id="<?php echo $value['id']; ?>b"  type="button" class="edit btn btn-success btn-sm">Редактировать</button></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
<?php include(ROOT.'/layout/footer.php');?>