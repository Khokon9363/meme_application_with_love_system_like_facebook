<div>
    @if(session()->has('success'))
        <div class="alert col-md-4 m-auto alert-success alert-dismissible fade show" role="alert">
            <p>{{ session('success') }}</p>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="collapse {{ $collapsed == true ? '' : 'show' }}" id="collapseStoreForm">
        <div class="col-sm-10 col-md-8 m-auto">
            <form wire:submit.prevent="store()" method="POST">
            @csrf
                <div class="card-body">
                    <input type="text" wire:model.debounce.500ms="title" wire:keyup="validation()" class="form-control mb-2" placeholder="Meme title ...">
                    <span class="text-danger">
                    @error('title')
                        {{ $message }}
                    @enderror
                    </span>
                    <textarea wire:model.debounce.500ms="meme" wire:keyup="validation()" class="form-control mt-1" rows="5" placeholder="Meme ..."></textarea>
                    <span class="text-danger">
                    @error('meme')
                        {{ $message }}
                    @enderror
                    </span><br>
                    <button type="submit" class="btn btn-primary mt-2">Publish</button>
                </div>
            </form>
        </div>
        <hr>
    </div>

    <div class="row mt-3">
        @foreach($memes as $meme)
        <div class="col-md-3">
            <div class="card border-info mb-3" style="max-width: 18rem;max-height: 250px;overflow-y:auto;">
                <div class="card-header sticky-top">
                    {{ ($meme->user) ? $meme->user->name : 'Anonymouse' }}
                    @php
                        $loved = false;
                    @endphp
                    @foreach($meme->loves as $loverId)
                        @if($loverId->user_id == $meme->user->id)
                            @php
                                $loved = 1;
                            @endphp
                        @endif
                    @endforeach
                    <button class="btn btn-sm {{ $loved ? 'btn-danger' : 'btn-outline-danger' }}" wire:click="love({{ $meme->id }})" {{ $loved ? 'disabled' : '' }} {{ auth()->check() ? '' : 'disabled' }} style="margin-left: 13px;">
                        <i class="fa fa-heart"></i>
                    </button>
                </div>
                <div class="card-body text-info">
                    <h5 class="card-title">
                        {{ $meme->meme }}
                    </h5>
                    <p class="card-text">
                        {{ $meme->meme }}
                    </p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="d-flex justify-content-center">
        <button class="btn btn-sm btn-outline-success" wire:click="loadMore()">
            Load More...
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
        </button>
    </div>

</div>