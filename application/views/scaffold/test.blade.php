@include('partials.top')
<div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Responsive Hover Table</h3>

              <div class="box-tools">
                <div class="input-group input-group-sm hidden-xs" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <table class="table table-hover table-bordered table-responsive">
                <tbody><tr>
                  <th style="width: 10px;">ID</th>
                  <th>User</th>
                  <th>Date</th>
                  <th style="width: 101px;"></th>
                  
                </tr>
                <tr>
                  <td>183</td>
                  <td>John Doe</td>
                  <td>27/12/2020</td>
                  <td>
                  	<span class="label label-success"><i class="fa fa-fw fa-eye"></i></span> 
                  	<span class="label label-warning"><i class="fa fa-fw fa-edit"></i></span> 
                  	<span class="label label-danger"><i class="fa fa-fw fa-remove"></i></span> 
                  </td>
                  
                </tr>
                <tr>
                  <td>219</td>
                  <td>Alexander Pierce</td>
                  <td>27/12/2020</td>
                  <td>
                  	<span class="label label-success"><i class="fa fa-fw fa-eye"></i></span> 
                  	<span class="label label-warning"><i class="fa fa-fw fa-edit"></i></span> 
                  	<span class="label label-danger"><i class="fa fa-fw fa-remove"></i></span> 
                  </td>
                  
                </tr>
                <tr>
                  <td>657</td>
                  <td>Bob Doe</td>
                  <td>27/12/2020</td>
                  <td>
                  	<span class="label label-success"><i class="fa fa-fw fa-eye"></i></span> 
                  	<span class="label label-warning"><i class="fa fa-fw fa-edit"></i></span> 
                  	<span class="label label-danger"><i class="fa fa-fw fa-remove"></i></span> 
                  </td>
                  
                </tr>
                <tr>
                  <td>175</td>
                  <td>Mike Doe</td>
                  <td>27/12/2020</td>
                  <td>
                  	<span class="label label-success"><i class="fa fa-fw fa-eye"></i></span> 
                  	<span class="label label-warning"><i class="fa fa-fw fa-edit"></i></span> 
                  	<span class="label label-danger"><i class="fa fa-fw fa-remove"></i></span> 
                  </td>
                  
                </tr>
              </tbody>
          </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>