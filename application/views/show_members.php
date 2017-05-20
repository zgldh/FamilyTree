<?php $this->_extends('Base/base'); ?>
<?php $this->_block('title'); ?>Show members<?php $this->_endblock(); ?>
<?php $this->_block('content');?>
<div id="container">
	<h1>Show All Members!<span onclick="Add()" class="pull-right glyphicon glyphicon-plus"></span></h1>

	<div id="body">
	<form>
        <table id="table_members" class="display">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Username</th>
                    <th>Sex</th>
                    <th>Birth</th>
                    <th>Mother</th>
                    <th>Father</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($members->result_array() as $row):?>
                <tr>
                    <td><?=$row['id']?></td>
                    <td><?=$row['name']?></td>
                    <td><?=['女', '男'][$row['sex']]?></td>
                    <td><?=date('Y-m-d H:i:s', $row['birthday'])?></td>
                    <td><?=$row['mname']?></td>
                    <td><?=$row['fname']?></td>
                    <td><button onclick="return DeleteItem(<?=$row['id']?>)">Delete</button><button onclick="return UpdateItem(this)">Update</button></td>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>
    </form>
	</div>

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
</div>
<div class="text-center">
	<button class=" btn btn-default btn-lg"><a href="relationship/check" target="_blank">click to check members relationship</a></button>
</div>
<?php $this->_endblock(); ?>
<?php $this->_block('script'); ?>
<script>
var table;
$(document).ready( function () {
    table = $('#table_members').DataTable();
} );

function Add(){
	trs = $('#table_members tbody');
	addition ='<tr><td></td><td><input type="text" class="form-control" name="name"/></td>';
	addition +='<td><select class="form-control" name="sex"><option value="1">男</option><option value="0">女</option></select></td>';
	addition += '<td><input type="date" class="form-control" name="birth"/></td>';
	addition += '<td><select class="form-control" name="mid"><option value="0">No</option><?php foreach ($members->result_array() as $row) { if($row['sex'] == 0) echo '<option value="'. $row['id'] . ' "> '. $row['name'] . '</option>'; }?></select></td>';
	addition += '<td><select class="form-control" name="fid"><option value="0">No</option> <?php foreach ($members->result_array() as $row) { if($row['sex'] == 1) echo '<option value="'. $row['id'] . ' "> '. $row['name'] . '</option>'; }?></select></td>';
	addition += '<td><button onclick="location.reload()">Reset</button><button onclick="AddItem();return false;">Save</button></td></tr>';
    trs.html(trs.html() + addition);
}

function AddItem(){
	$.ajax({
	    type: 'post',
	    url: 'show/add',
	    data: $("form").serialize(),
	    success: function(data) {
	         if(data == 'ok'){
	        	 alert('ok');
       	      	 location.reload();	
		     }else{
		    	 alert(data + '!')
		    	 return false;
			 }
	    }
	});

}
function DeleteItem(id){
	$.ajax({
	    type: 'get',
	    url: 'show/delete',
	    data: 'id='+id,
	    success: function(data) {
	         if(data == 'ok'){
	        	 alert('ok');
       	      	 location.reload();	
		     }else{
		    	 alert(data + '!')
		    	 return false;
			 }
	    }
	});
}
function UpdateItem(obj){
	var tds=$(obj).parents("tr").children();
	$.each(tds, function(i,val){
        var jqob=$(val);
        if(i < 1 || jqob.has('button').length ){
            if(i <1){
            	var txt=jqob.text();
                var put=$("<input type='hidden'>");
                put.val(txt);
                jqob.html(put);
            }
            return true;
        }
        var txt=jqob.text();
        //@todo don`t all blank should be input , also select.............but.....I am lazy...........
        var put=$("<input type='text'>");
        put.val(txt);
        jqob.html(put);
    });
    $(obj).html("save");
    $(obj).attr("onclick", "return Save(this)");
    return false;
}
function Save(obj){
    var row=table.row($(obj).parents("tr"));
    var tds=$(obj).parents("tr").children();
    $.each(tds, function(i,val){
        var jqob=$(val);
        //把input变为字符串
        if(!jqob.has('button').length){
            var txt=jqob.children("input").val();

            jqob.html(txt);
            table.cell(jqob).data(txt);
        }
    });
    var data=row.data();
    $.ajax({
        "url":"show/update",
        "data":'data='+data,
        "type":"post",
        "error":function(){
            alert("try agian");
            return false;
        },
        "success":function(data){
        	alert(data);
        }
    });
}
</script>
<?php $this->_endblock(); ?>

