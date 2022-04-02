<x-layout>
    <x-slot:title>
        Celebrities list
    </x-slot>

    <div class="container py-3 text-center" id="displayDetails">
        <h1 class="fw-bolder">Celebrity News</h1>

<!-- Button trigger create cemlebrity modal -->
        <div>
            <button type="button" class="btn btn-success my-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Create a celebriry sheet
            </button>
        </div>

<!-- Create celebrity Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen-md-down">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Create a celebrity sheet</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
            <!-- Form to create a celebrity sheet -->
                        <form method="post" id="createForm" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="firstname" class="form-label">Firstname</label>
                                <input type="text" class="form-control" name="firstname" id="firstname">
                            </div>
                            <div class="mb-3">
                                <label for="lastname" class="form-label">Lastname</label>
                                <input type="text" class="form-control" name="lastname" id="lastname">
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <input type="text" class="form-control" name="description" id="description">
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Image</label>
                                <input type="file" accept="image/png, image/jpeg" class="form-control" name="image" id="image" aria-describedby="uploadHelp">
                                <div id="uploadHelp" class="form-text">Accepted file format : png, jpeg</div>
                            </div>
                            <button type="submit" id="createCelebritySheet" class="btn btn-primary">Submit</button>
                        </form>
            <!-- End of creation form -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
<!-- End of create celebrity modal -->

        <div class="main_content_wrapper d-flex row">
            @if ($celebrities->count() > 0)
                <div class="celebrities_name_wrapper col-md-4 p-0" id="celebrity_name_wrapper" style="background-color:lightgrey;">
                    @foreach ($celebrities as $celebrity)
                        <h3 class="m-0 celebrity-h3 d-flex p-2" style="border:1px solid black"> 
                            <button onclick="getClickedCelebrity({{$celebrity->id}})" id="{{$celebrity->id}}" class="celebrities btn btn-link text-decoration-none text-dark w-100" name="{{$celebrity->id}}"> {{ $celebrity->firstname }} {{ $celebrity->lastname }} </button> 
                            <div class="btn btn-group">
                                <button onclick="deleteClickedCelebrity({{$celebrity->id}})" id="{{$celebrity->id}}" class="btn btn-danger">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                        <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                    </svg>
                                </button>
                                <!-- Button trigger update cemlebrity modal -->
                                <button type="button" onclick="updateClickedCelebrity({{$celebrity->id}})" id="{{$celebrity->id}}" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear-fill" viewBox="0 0 16 16">
                                        <path d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872l-.1-.34zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z"/>
                                    </svg>
                                </button>
                            </div>

                            <!-- Update celebrity Modal -->
                                    <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModal2Label" aria-hidden="true">
                                        <div class="modal-dialog modal-fullscreen-md-down">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel2">Create a celebrity sheet</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                        <!-- Form to update a celebrity sheet -->
                                                    <form method="post" id="updateForm" enctype="multipart/form-data">
                                                    @csrf
                                                        <div class="mb-3">
                                                            <label for="firstname_update" class="form-label">Firstname</label>
                                                            <input type="text" class="form-control" name="firstname_update" id="firstname_update">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="lastname_update" class="form-label">Lastname</label>
                                                            <input type="text" class="form-control" name="lastname_update" id="lastname_update">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="description_update" class="form-label">Description</label>
                                                            <input type="text" class="form-control" name="description_update" id="description_update">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="image_update" class="form-label">Image</label>
                                                            <input type="file" accept="image/png, image/jpeg" class="form-control" name="image_update" id="image_update" aria-describedby="uploadHelp">
                                                            <div id="uploadHelp" class="form-text">Accepted file format : png, jpeg</div>
                                                        </div>
                                                        <button type="submit" id="updateCelebritySheet" class="btn btn-primary">Update</button>
                                                    </form>
                                        <!-- End of update form -->
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            <!-- End of create celebrity modal -->
                        </h3>
                    @endforeach
                </div>
                <div id="celebrity_details_card" class="celebrity_details_card col-md-8 p-3" style="background-color:cornflowerblue">

                    @if(isset($celebrityInfo))
                        <div class="w-100 p-3">
                            <img src="{{ asset('storage/upload/'.$celebrityInfo['image']) }}" class="float-start img-border-radius img-thumbnail w-50" alt="Celebrity photo" title="Celebrity photo">
                            <br><br>
                            <p class="fw-bold">{{$celebrityInfo['firstname']}} {{$celebrityInfo['lastname']}}</p>
                            <p>{{$celebrityInfo['description']}}</p>
                        </div>
                    @else 
                        <h2 class="fw-bold">Click on a celebrity to display details</p>
                    @endif
                </div>
            @else
                <span>No celebrities found in the database</span>
            @endif
        </div>
    </div>

    @push('scripts')
        <script src="{{asset('js/manageCelebrityDetails.js')}}"></script>
    @endpush
</x-layout>