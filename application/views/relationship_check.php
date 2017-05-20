<?php $this->_extends('Base/base'); ?>
<?php $this->_block('title'); ?>Relationship Check<?php $this->_endblock(); ?>
<?php $this->_block('content');?>
<div id="container">
<h1>Select A and B to check their relationship!</h1>
	<div id="body">
    	<form>
    	   A:<select class="form-control" name="A">
              <?php foreach($members->result_array() as $row):?>
              <option value="<?=$row["id"]?>"><?=$row['name']?></option>
              <?php endforeach;?>
            </select>
            B:<select class="form-control" name="B">
              <?php foreach($members->result_array() as $row):?>
              <option value="<?=$row["id"]?>"><?=$row['name']?></option>
              <?php endforeach;?>
            </select>
            <hr>
            <button class="btn btn-default" onclick="sub();return false;">Check!</button>
    	</form>
	</div>
</div>

<?php $this->_endblock(); ?>
<?php $this->_block('script'); ?>
<script>
function sub(){
	$.ajax({
        "url":"check",
        "data":$('form').serialize(),
        "type":"post",
        "error":function(){
            alert("try agian");
            return false;
        },
        "success":function(data){
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
</script>
<?php $this->_endblock(); ?>

