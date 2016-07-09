@extends(settings('theme_folder') . 'master')

@section('page-title', 'Manage Settings')

@section('page-header')
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manage Settings
      <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Manage Settings</li>
    </ol>
  </section>
@endsection

@section('content')
  <div class="section">
    <div class="row">
      <div class="col-sm-4">
        <div class="box box-primary">
          {{--Header--}}
          <div class="box-header with-border">
            <h3 class="box-title">Set applicatoin settings</h3>
          </div>

          {{--Content--}}
          <div class="box-body">
            <form action="{{route('settings.save')}}" method="post">
              {{ csrf_field() }}
              <table class="table table-hover table-striped table-bordered">
                <thead>
                <tr>
                  <th>Setting name</th>
                  <th>Current value</th>
                </tr>
                </thead>

                <tbody>
                @foreach($settings as $name => $value)
                  <tr>
                    <td>{{$name}}</td>
                    @if($value != "true" && $value != "false")
                      <td><input type="text"
                                 class="form-control"
                                 name="{{$name}}"
                                 value="{{$value}}"/>
                      </td>
                    @else
                      <td>
                        <select name="{{$name}}" class="form-control">
                          <option value="true" {{$value == "true" ? 'selected' : ''}}>True</option>
                          <option value="false" {{$value == "false" ? 'selected' : ''}}>False</option>
                        </select>
                      </td>
                    @endif
                  </tr>
                @endforeach
                <tr>
                  <td colspan="2">
                    <button class="btn btn-success">
                      <i class="fa fa-save"></i>
                      Save Settings
                    </button>
                  </td>
                </tr>
                </tbody>

              </table>
            </form>
          </div>

          <div>

          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts-footer')
  <!-- AdminLTE for demo purposes -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/icheck.min.js"></script>
  <script src="{{theme_url('js/demo.js')}}"></script>
  <script>
    $(document).ready(function () {
      $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' // optional
      });
    });
  </script>
@endsection
