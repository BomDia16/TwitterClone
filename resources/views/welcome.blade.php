<!DOCTYPE HTML>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">

		<title>Twitter clone</title>
		<link rel="icon" href="{{ asset('assets/imagens/icone_twitter.png') }}">

		<!-- jquery - link cdn -->
		<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>

		<!-- bootstrap - link cdn -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="{{ asset('assets/css/estilo.css') }}" rel="stylesheet">
	
		<script>
			// código javascript						
		</script>
	</head>

	<body>

		<!-- Static navbar -->
	    <nav class="navbar navbar-default navbar-static-top">
	      <div class="container">
	        <div class="navbar-header">
	          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
	            <span class="sr-only">Toggle navigation</span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	          </button>
	          <img src="{{ asset('assets/imagens/icone_twitter.png') }}" />
	        </div>
	        
	        <div id="navbar" class="navbar-collapse collapse">
	          <ul class="nav navbar-nav navbar-right">
	            <li><a href="{{ route('user.create') }}">Inscrever-se</a></li>
	            <li class="">
	            	<a id="entrar" data-target="#" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Entrar</a>
					<ul class="dropdown-menu" aria-labelledby="entrar">
						<div class="col-md-12">
				    		<p>Você possui uma conta?</h3>
				    		<br />
							<div>
								@if ($errors->any())
									<ul>
										@foreach ($errors->all() as $error)
											<li class="text-danger">{{ $error }}</li>
										@endforeach
									</ul>
								@endif
							</div>	
							<form method="post" action="{{ route('user.login') }}" id="formLogin">
								@csrf
								
								<div class="form-group">
									<input type="text" class="form-control" id="campo_usuario" name="usuario" placeholder="Usuário" required="requiored"/>
									@error('usuario')
                                        <div class="text-danger">
                                            {{$message}}
                                        </div>
                                    @enderror
								</div>
								
								<div class="form-group">
									<input type="password" class="form-control red" id="campo_senha" name="senha" placeholder="Senha" required="requiored"/>
									@error('senha')
                                        <div class="text-danger">
                                            {{$message}}
                                        </div>
                                    @enderror
								</div>
								
								<button type="buttom" class="btn btn-primary" id="btn_login">Entrar</button>

								<br /><br />
								
							</form>
						</form>
				  	</ul>
	            </li>
	          </ul>
	        </div><!--/.nav-collapse -->
	      </div>
	    </nav>


	    <div class="container">

	      <!-- Main component for a primary marketing message or call to action -->
	      <div class="jumbotron">
	        <h1>Welcome to Twitter Clone</h1>
	        <p>Look at what is happening now...</p>
	      </div>

	      <div class="clearfix"></div>
		</div>


	    </div>
	
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	
	</body>
</html>