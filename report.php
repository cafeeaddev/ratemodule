<?php 
require_once("../../config.php");
 
global $DB,$CFG,$USER,$PAGE,$COURSE;

if ($CFG->forcelogin) {
    require_login();
}
  $systemcontext = context_system::instance();
        if(has_capability('moodle/site:config', $systemcontext)) {
echo '<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
    $("#example").DataTable( {
        "language": {
            "sEmptyTable": "Nenhum registro encontrado",
    "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
    "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
    "sInfoFiltered": "(Filtrados de _MAX_ registros)",
    "sInfoPostFix": "",
    "sInfoThousands": ".",
    "sLengthMenu": "_MENU_ resultados por página",
    "sLoadingRecords": "Carregando...",
    "sProcessing": "Processando...",
    "sZeroRecords": "Nenhum registro encontrado",
    "sSearch": "Pesquisar: ",
    "oPaginate": {
        "sNext": " Próximo ",
        "sPrevious": " Anterior ",
        "sFirst": "Primeiro",
        "sLast": "Último"
    },
    "oAria": {
        "sSortAscending": ": Ordenar colunas de forma ascendente",
        "sSortDescending": ": Ordenar colunas de forma descendente"
    }
        }
    } );
} );
 ';

$PAGE->set_pagetype('site-report-cafe'); 
$PAGE->set_title($SITE->fullname);
$PAGE->set_heading($SITE->fullname); 

echo $OUTPUT->header();

$sql = "SELECT cm.id, CONCAT(u.firstname, ' ', u.lastname) as 'aluno', bm.rating as 'nota', c.fullname as 'curso' ,
CASE
  WHEN cm.module = 9 THEN (SELECT forum.name FROM mdl_forum AS forum WHERE forum.id = cm.instance )  
  WHEN cm.module = 1 THEN (SELECT assign.name FROM mdl_assign AS assign WHERE assign.id = cm.instance ) 
  WHEN cm.module = 2 THEN (SELECT assignment.name FROM mdl_assignment AS assignment WHERE assignment.id = cm.instance ) 
  WHEN cm.module = 3 THEN (SELECT book.name FROM mdl_book AS book WHERE book.id = cm.instance ) 
  WHEN cm.module = 4 THEN (SELECT chat.name FROM mdl_chat AS chat WHERE chat.id = cm.instance ) 
  WHEN cm.module = 5 THEN (SELECT choice.name FROM mdl_choice AS choice WHERE choice.id = cm.instance ) 
  WHEN cm.module = 6 THEN (SELECT data.name FROM mdl_data AS data WHERE data.id = cm.instance ) 
  WHEN cm.module = 7 THEN (SELECT feedback.name FROM mdl_feedback AS feedback WHERE feedback.id = cm.instance ) 
  WHEN cm.module = 8 THEN (SELECT folder.name FROM mdl_folder AS folder WHERE folder.id = cm.instance ) 
  WHEN cm.module = 10 THEN (SELECT glossary.name FROM mdl_glossary AS glossary WHERE glossary.id = cm.instance ) 
  WHEN cm.module = 11 THEN (SELECT h5pactivity.name FROM mdl_h5pactivity AS h5pactivity WHERE h5pactivity.id = cm.instance ) 
  WHEN cm.module = 13 THEN (SELECT label.name FROM mdl_label AS label WHERE label.id = cm.instance ) 
  WHEN cm.module = 14 THEN (SELECT lesson.name FROM mdl_lesson AS lesson WHERE lesson.id = cm.instance ) 
  WHEN cm.module = 15 THEN (SELECT lti.name FROM mdl_lti AS lti WHERE lti.id = cm.instance ) 
  WHEN cm.module = 16 THEN (SELECT page.name FROM mdl_page AS page WHERE page.id = cm.instance )
  WHEN cm.module = 17 THEN (SELECT quiz.name FROM mdl_quiz AS quiz WHERE quiz.id = cm.instance ) 
  WHEN cm.module = 18 THEN (SELECT resource.name FROM mdl_resource AS resource WHERE resource.id = cm.instance ) 
  WHEN cm.module = 19 THEN (SELECT scorm.name FROM mdl_scorm AS scorm WHERE scorm.id = cm.instance )  
  WHEN cm.module = 20 THEN (SELECT survey.name FROM mdl_survey AS survey WHERE survey.id = cm.instance )  
  WHEN cm.module = 21 THEN (SELECT url.name FROM mdl_url AS url WHERE url.id = cm.instance )  
  WHEN cm.module = 22 THEN (SELECT wiki.name FROM mdl_wiki AS wiki WHERE wiki.id = cm.instance )  
  WHEN cm.module = 23 THEN (SELECT workshop.name FROM mdl_workshop AS workshop WHERE workshop.id = cm.instance )  
END AS 'module_name'
FROM mdl_block_ratemodule as bm
join mdl_course_modules as cm on cm.id = bm.coursemoduleid
join mdl_course as c on c.id = cm.course
join mdl_user as u on u.id = bm.userid";
$retorno = $DB->get_records_sql($sql,array(),0,99999999);
?>
<style>
    #ccnSearchOverlayWrap {
    display: none; 
}
</style>
<table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr >
                <th>ID</th>
                <th>Aluno</th>
                <th>Atividade</th>
                <th>Nota</th>
                <th>Curso</th>  
        
            </tr>
        </thead>
        <tbody>

            <?php
           
            foreach($retorno as $dados){ 
                ?>
           <tr>
            
                <td><?php echo $dados->id ?></td>
                <td><?php echo $dados->aluno ?></td>
                <td><?php echo $dados->module_name ?></td>
                <td><?php echo $dados->nota ?></td>
                <td><?php echo $dados->curso ?></td>
            
            
            </tr>
           <?php } ?>

        </tbody>
        <tfoot>
            <tr>
                <th>ID</th>
                <th>Aluno</th>
                <th>Atividade</th>
                <th>Nota</th>
                <th>Curso</th>  
            </tr>
        </tfoot>
    </table>
<?php
}
?>
