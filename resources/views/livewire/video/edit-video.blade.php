@if( $video->processed )
    <div>
@else
    <div wire:poll >
@endif
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h1>Edit information about the video</h1></div>
                    <div class="card-body">
                        @if( ! $video->processed )
                            <div class="row">
                                <p>Processing ({{$this->video->processed_percentage}})</p>
                            </div>
                        @endif
                        <div class="row">
                            @if($this->video->thumbnail)
                                <img src="{{ asset($this->video->thumbnail)}}" class="img-preview mb-4" alt="Preview image">
                            @endif
                        </div>
                        @if(session()->has('message'))
                            <div class="alert alert-success">
                                {{ session('message')}}
                            </div>
                        @endif
                        <form wire:submit.prevent="update">
                            <div class="form-group">
                                <label for="title">Tile</label>
                                <input type="text" class="form-control" wire:model="title">
                                @error('video.title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea cols="30" rows="4" class="form-control" wire:model="description"></textarea>
                                @error('video.description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="description">Visibility</label>
                                <select wire:model="visibility" class="form-control">
                                    @foreach(\App\Enums\VideoVisibility::cases() as $visibility)
                                        <option value="{{ $visibility->value }}">{{ $visibility->name }}</option>
                                    @endforeach
                                </select>
                                @error('video.visibility')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <button
                                   type="submit"
                                   class="btn btn-primary"
                                   wire:loading.attr="disabled"
                                   >
                                    Save
                                </button>
                                <div wire:dirty wire:loading.remove>Unsaved changes...</div>
                                <div wire:loading>
                                    Saving...
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
