<!-- form start -->
                        <div class="row">
                          <div class="col-md-4">
                            <div class="form-group">
                              {{Form::label('name','Role Name')}}
                              {{Form::text('name', null,['class' => 'form-control','id' => 'id','placeholder' => 'Enter Role'])}}
                              
                          </div>
                          </div>

                          <div class="col-md-12">
                            {{Form::button(isset($model)? 'Update' : 'Save', ['class' => 'btn btn-primary','type' => 'submit'])}}
                          </div>
                        </div>
                          
                          