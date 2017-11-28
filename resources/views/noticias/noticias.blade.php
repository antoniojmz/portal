@extends('menu.index')
@section('content')
<div class="container col-md-10" style="background-color: white;">
	<form class="m-form m-form--fit m-form--label-align-right">
		<div class="m-portlet__body">
			<div class="form-group m-form__group row">
				<label class="col-form-label col-lg-3 col-sm-12">
					Title
				</label>
				<div class="col-lg-7 col-md-7 col-sm-12">
					<input type="email" class="form-control m-input" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter post title">
				</div>
			</div>
			<div class="form-group m-form__group row">
				<label class="col-form-label col-lg-3 col-sm-12">
					Content
				</label>
				<div class="col-lg-7 col-md-7 col-sm-12">
					<div class="summernote"></div>
				</div>
			</div>
		</div>
		<div class="m-portlet__foot m-portlet__foot--fit">
			<div class="m-form__actions m-form__actions">
				<div class="row">
					<div class="col-lg-9 ml-lg-auto">
						<button type="reset" class="btn btn-brand">
							Submit
						</button>
						<button type="reset" class="btn btn-secondary">
							Cancel
						</button>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>
<script Language="Javascript">
</script>
<script src="{{ asset('js/noticias/noticias.js') }}"></script>
@endsection