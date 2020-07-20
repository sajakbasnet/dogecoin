<!DOCTYPE html>
<html lang="en">
<head>
  @include('system.layouts.layoutHeader')
</head>

<body>
@include('system.partials.header')
<div class="page-wrapper">
  @include('system.partials.sidebar')
  <div class="page-contents clearfix">
    <div class="inner-content-fluid">
      <div class="custom-container-fluid">
        @include('system.partials.breadcrumb')
        @yield('content')
      </div>
    </div>
  </div><!-- ends page-contents -->
</div><!-- page-wrapper -->

<div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <form method="post">
      <div class="modal-content">
        @csrf
        <div class="modal-header">
          <h4 class="modal-title">{{translate('Confirm Delete')}}</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          {{translate('Are you sure you want to delete?')}}
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">
            <i class="glyph-icon icon-close"></i> {{translate('Cancel')}}
          </button>
          <button type="submit" class="btn btn-sm btn-danger" id="confirmDelete">
            <i class="glyph-icon icon-trash"></i> {{translate('Delete')}}
          </button>
        </div>
      </div>
    </form>
  </div>
</div>

@include('system.layouts.layoutFooter')
@yield('scripts')
</body>
</html>
