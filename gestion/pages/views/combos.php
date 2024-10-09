<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>HUMBERTO RIVAS - CONSTRUCCIONES</title>


    <link href="https://unpkg.com/multiple-select@1.7.0/dist/multiple-select.min.css" rel="stylesheet">

<script src="https://cdn.jsdelivr.net/npm/jquery/dist/jquery.min.js"></script>
<script src="https://unpkg.com/multiple-select@1.7.0/dist/multiple-select.min.js"></script>
  </head>

  <body>
    <?php
      // Mínimo control de acceso
      //require('../../includes/include-pagina-restringida.php'); //el incude para vericar que estoy logeado. Si falla salta a la página de login.php
    ?>

  <div class="page">
			   <?php
           // include "header.php";
          ?>
	  <!-- ZONA PRINCIPAL -->

      <div class="page-wrapper">
        <div class="container-fluid">
        </div>
        <div class="page-body">
          <div class="container-fluid">
            <div class="row row-deck row-cards">
			           <div class="col-12">
                   <div class="card">
                     <div class="card-header">
                       <h3 class="card-title"><?php //echo $ruta; ?></h3>
                     </div> 
                     <div class="card-body border-bottom py-3">
                      <!-- FORMULARIO DE BÚSQUEDA -->
                      <!-- NOMBRE TRABAJADOR -->
                      <div style="margin:10px">


                      <form>
                          OBRA: 

                          <select id="search_name" >
				                    <option>DEPURADORA GENEPOL</option>
				                    <option>Ana Trujillo</option>
				                    <option>Antonio Moreno</option>
			                    </select>
			                    <input type="submit" id="button_search_name" value="Filter">
                          </form>


                          <label class="form-label">Tags input</label>
                            <select type="text" class="form-select" placeholder="Select tags" id="select-tags" value="" multiple>
                              <option value="HTML">HTML</option>
                              <option value="JavaScript">JavaScript</option>
                              <option value="CSS">CSS</option>
                              <option value="jQuery">jQuery</option>
                              <option value="Bootstrap">Bootstrap</option>
                              <option value="Ruby">Ruby</option>
                              <option value="Python">Python</option>
                            </select>

                            <!-- The second value will be selected initially -->
<select name="select" multiple="multiple">
  <option value="value1">Value 1</option>
  <option value="value2" selected>Value 2</option>
  <option value="value3">Value 3</option>
</select>
<script>
$(function() {
			$('select[multiple]').multipleSelect()
		})
</script>	
<br>
<br>
<select multiple="multiple">
        <option value="1">January</option>
        <option value="2">February</option>
        <option value="3">March</option>
        <option value="4">April</option>
        <option value="5">May</option>
        <option value="6">June</option>
        <option value="7">July</option>
        <option value="8">August</option>
        <option value="9">September</option>
        <option value="10">October</option>
        <option value="11">November</option>
        <option value="12">December</option>
      </select>
<br>
<br>



<legend>Search Templates</legend>
			<form>
			<select id="search_name" multiple="multiple">
				<option>Maria Anders</option>
				<option>Ana Trujillo</option>
				<option>Antonio Moreno</option>
			</select>
			<input type="submit" id="button_search_name" value="Filter">
			</form>
		</fieldset>
		<script>
		$(function() {
			$('select[multiple]').multipleSelect()
		})
		</script>	

<br>


<style>
select {
  width: 100%;
}
</style>

<div>
  <div class="form-group row">
    <label class="col-sm-2">
      Basic Select
    </label>

    <div class="col-sm-10">
      <select multiple="multiple">
        <option value="1">January</option>
        <option value="2">February</option>
        <option value="3">March</option>
        <option value="4">April</option>
        <option value="5">May</option>
        <option value="6">June</option>
        <option value="7">July</option>
        <option value="8">August</option>
        <option value="9">September</option>
        <option value="10">October</option>
        <option value="11">November</option>
        <option value="12">December</option>
      </select>
    </div>
  </div>

  <div class="form-group row">
    <label class="col-sm-2">
      Multiple Select
    </label>

    <div class="col-sm-10">
      <select multiple="multiple" class="multiple-select">
        <option value="1">January</option>
        <option value="2">February</option>
        <option value="3">March</option>
        <option value="4">April</option>
        <option value="5">May</option>
        <option value="6">June</option>
        <option value="7">July</option>
        <option value="8">August</option>
        <option value="9">September</option>
        <option value="10">October</option>
        <option value="11">November</option>
        <option value="12">December</option>
      </select>
    </div>
  </div>

  <hr>

  <div class="form-group row">
    <label class="col-sm-2">
      Group Select
    </label>

    <div class="col-sm-10">
      <select multiple="multiple">
        <optgroup label="Group 1">
          <option value="1">Option 1</option>
          <option value="2">Option 2</option>
          <option value="3">Option 3</option>
        </optgroup>
        <optgroup label="Group 2">
          <option value="4">Option 4</option>
          <option value="5">Option 5</option>
          <option value="6">Option 6</option>
        </optgroup>
        <optgroup label="Group 3">
          <option value="7">Option 7</option>
          <option value="8">Option 8</option>
          <option value="9">Option 9</option>
        </optgroup>
      </select>
    </div>
  </div>

  <div class="form-group row">
    <label class="col-sm-2">
      Multiple Select
    </label>

    <div class="col-sm-10">
      <select multiple="multiple" class="multiple-select">
        <optgroup label="Group 1">
          <option value="1">Option 1</option>
          <option value="2">Option 2</option>
          <option value="3">Option 3</option>
        </optgroup>
        <optgroup label="Group 2">
          <option value="4">Option 4</option>
          <option value="5">Option 5</option>
          <option value="6">Option 6</option>
        </optgroup>
        <optgroup label="Group 3">
          <option value="7">Option 7</option>
          <option value="8">Option 8</option>
          <option value="9">Option 9</option>
        </optgroup>
      </select>
    </div>
  </div>
</div>

<script>
  $(function() {
    $('.multiple-select').multipleSelect()
  })
</script>






                      
                      </div>
                    </div>
                  </div>
                  
                  
                </div>
              </div>
        </div>
        <!-- FOOTER -->
        <?php
          include("footer.php");
         ?>
        <!-- FIN FOOTER -->
      </div>
    </div>














<!-- Tabler Core -->
<!-- <script src="../../vendors/tabler/js/tabler.min.js"></script> -->

</body>
</html>
