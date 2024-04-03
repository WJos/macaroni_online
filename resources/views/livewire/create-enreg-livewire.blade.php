<div class="card" @if(!$isOpen) hidden @endif>
    <div class="card-header">
        <button wire:click="closeModal()" class="btn btn-secondary"><i class="fas fa-angle-left pr-1"></i> Back</button>
    </div>
    <form method="POST" wire:submit.prevent="store()">
                <!-- SELECT2 EXAMPLE -->
  <div class="card card-default">
    <div class="card-header">
      <h3 class="card-title">Select2 (Default Theme)</h3>

      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse">
          <i class="fas fa-minus"></i>
        </button>
        <button type="button" class="btn btn-tool" data-card-widget="remove">
          <i class="fas fa-times"></i>
        </button>
      </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Minimal</label>
            <select class="form-control select2" style="width: 100%;">
              <option selected="selected">Alabama</option>
              <option>Alaska</option>
              <option>California</option>
              <option>Delaware</option>
              <option>Tennessee</option>
              <option>Texas</option>
              <option>Washington</option>
            </select>
          </div>
          <!-- /.form-group -->
          <div class="form-group">
            <label>Disabled</label>
            <select class="form-control select2" disabled="disabled" style="width: 100%;">
              <option selected="selected">Alabama</option>
              <option>Alaska</option>
              <option>California</option>
              <option>Delaware</option>
              <option>Tennessee</option>
              <option>Texas</option>
              <option>Washington</option>
            </select>
          </div>
          <!-- /.form-group -->
        </div>
        <!-- /.col -->
        <div class="col-md-6">
          <div class="form-group">
            <label>Multiple</label>
            <select class="select2" multiple="multiple" data-placeholder="Select a State" style="width: 100%;">
              <option>Alabama</option>
              <option>Alaska</option>
              <option>California</option>
              <option>Delaware</option>
              <option>Tennessee</option>
              <option>Texas</option>
              <option>Washington</option>
            </select>
          </div>
          <!-- /.form-group -->
          <div class="form-group">
            <label>Disabled Result</label>
            <select class="form-control select2" style="width: 100%;">
              <option selected="selected">Alabama</option>
              <option>Alaska</option>
              <option disabled="disabled">California (disabled)</option>
              <option>Delaware</option>
              <option>Tennessee</option>
              <option>Texas</option>
              <option>Washington</option>
            </select>
          </div>
          <!-- /.form-group -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <h5>Custom Color Variants</h5>
      <div class="row">
        <div class="col-12 col-sm-6">
          <div class="form-group">
            <label>Minimal (.select2-danger)</label>
            <select class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
              <option selected="selected">Alabama</option>
              <option>Alaska</option>
              <option>California</option>
              <option>Delaware</option>
              <option>Tennessee</option>
              <option>Texas</option>
              <option>Washington</option>
            </select>
          </div>
          <!-- /.form-group -->
        </div>
        <!-- /.col -->
        <div class="col-12 col-sm-6">
          <div class="form-group">
            <label>Multiple (.select2-purple)</label>
            <div class="select2-purple">
              <select class="select2" multiple="multiple" data-placeholder="Select a State" data-dropdown-css-class="select2-purple" style="width: 100%;">
                <option>Alabama</option>
                <option>Alaska</option>
                <option>California</option>
                <option>Delaware</option>
                <option>Tennessee</option>
                <option>Texas</option>
                <option>Washington</option>
              </select>
            </div>
          </div>
          <!-- /.form-group -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
      Visit <a href="https://select2.github.io/">Select2 documentation</a> for more examples and information about
      the plugin.
    </div>
  </div>
  <!-- /.card -->
        {{-- <div class="card-body">
            <div class="form-row">
                
                
                <div class="form-group col-12">
                    <label for="client_id">Select</label>
                    <select wire:model="client_id" class="form-control @error('client_id') is-invalid @enderror" required="required">
                        <option value="" selected="selected">- Select -</option>
                        @foreach($clients AS $client)
                        <option value="{{ $client->id }}">{{ $client->name }}</option>
                        @endforeach
                    </select>
                    @error('client_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                
                <div class="form-group col-12">
                    <label for="crud_example_try_photo">Photo</label>
                    <input type="file" wire:model="crud_example_try_photo" id="crud_example_try_photo" class="form-control @error('crud_example_try_photo') is-invalid @enderror">
                    @error('crud_example_try_photo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                
                <div class="form-group col-12">
                    <label for="crud_example_try_string">String</label>
                    <input type="text" wire:model="crud_example_try_string" id="crud_example_try_string" class="form-control @error('crud_example_try_string') is-invalid @enderror">
                    @error('crud_example_try_string') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                
                <div class="form-group col-12">
                    <label for="crud_example_try_number">Number</label>
                    <input type="text" wire:model="crud_example_try_number" id="crud_example_try_number" class="form-control @error('crud_example_try_number') is-invalid @enderror">
                    @error('crud_example_try_number') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                
                <div class="form-group col-12">
                    <label for="crud_example_try_textarea">Textarea</label>
                    <textarea wire:model="crud_example_try_textarea" id="crud_example_try_textarea" class="form-control @error('crud_example_try_textarea') is-invalid @enderror"></textarea>
                    @error('crud_example_try_textarea') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

            </div>
        </div>
        <div class="card-footer text-right">
            <button type="reset" class="btn btn-danger">Reset</button>
            <button type="button" wire:click.prevent="store()" class="btn btn-success">Save</button>
        </div> --}}
    </form>
</div>