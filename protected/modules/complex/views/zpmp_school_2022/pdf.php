<p align="center" style="margin-top: 130px; margin-bottom: 30px;"><b>Запрос</b></p>
<p>Данные запроса:<br />
 - Дата запроса: <b><?php echo $model->pok13; ?></b>,<br>
 - Организация направившая запрос: <b><?php echo $model->report->est->est_name; ?></b>,<br> 
 - ФИО родителя (законного представителя), проходящего военную службу: <b><?php echo $model->pok1.' '.$model->pok2.' '.$model->pok3; ?></b>,<br>
 - Дата рождения родителя (законного представителя), проходящего военную службу: <b><?php echo $model->pok4; ?></b>,<br>
 - Адрес регистрации родителя (законного представителя), проходящего военную службу: <b><?php echo $model->get_region().$model->get_addr(); ?></b>
</p>
<p>Ответ на запрос:<br />
 - Результат запроса: <b><?php echo $model->get_pok15(); ?></b>,<br>    
 - Данные актуальны по состоянию на: <b><?php echo $model->pok16; ?></b>,<br>
</p>
 
