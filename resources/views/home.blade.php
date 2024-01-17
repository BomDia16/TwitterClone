<!DOCTYPE HTML>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">

		<title>Twitter clone - Home</title>
		<link rel="icon" href="{{ asset('assets/imagens/icone_twitter.png') }}">

		<!-- jquery - link cdn -->
		<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>

		<!-- bootstrap - link cdn -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	
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
	            <li><a class="dropdown-item black-text" href=""
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('user.logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
	          </ul>
	        </div><!--/.nav-collapse -->
	      </div>
	    </nav>


	    <div class="container">
	    	<div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h4>
                            {{ auth()->user()->usuario }}
                        </h4>
                        <hr>
                        <div class="col-md-6">
                            TWEETS: <br> {{ count($tweets) }}
                        </div>
                        <div class="col-md-6">
                            SEGUIDORES <br> 1
                        </div>
                    </div>
                </div>
            </div>
	    	<div class="col-md-6">
	    		<div class="panel panel-default">
                    <div class="panel-body">
                        <form action="{{ route('tweet.store') }}" method="post" class="input-group" id="form_tweet">
                            @csrf
                            @if ($errors->any())
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li class="text-danger">{{ $error }}</li>
                                    @endforeach
                                </ul>
                            @endif
                            <input type="text" class="form-control" placeholder="O que está acontecendo agora?" name="tweet" id="tweet" maxlength="140">
                            <span class="input-group-btn">
                                <button class="btn btn-default" id="btn_tweet" type="submit">Tweet</button>
                            </span>
                        </form>
                    </div>
                </div>

                <div id="tweets" class="list-group">
                    @forelse($tweets as $tweet)
                        <a href="#" class="list-group-item">
                            <h4 class="list-group-item-heading">{{ $tweet->usuario }} <small>{{ $tweet->created_at }}</small></h4>
                            <p class="list-group-item-text">{{ $tweet->tweet }}</p>
                        </a>
                    @empty
                    @endforelse
                </div>
			</div>
			<div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h4><a href="{{ route('user.procurar') }}">Procurar por pessoas</a></h4>
                    </div>
                </div>
            </div>
		</div>


	    </div>
	
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	
	</body>
</html>