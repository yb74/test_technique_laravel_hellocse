const manageDeleteMessage = () => {
    alert("The celebrity sheet has been deleted");
}

// ############################### get the clicked celebrity sheet ################################# //
const getClickedCelebrity = (id) => {
    const elt = document.getElementById(id);
    console.log("clicked Element = %o", elt);

    $.ajax({
        url: `celebrities/${id}`,
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            _token: $("input[name=_token]").val()
        },
        success: response => {
            // $("#"+id).css("background-color", "lightgreen");
            // manageDeleteMessage();
            
            // console.log(response);

            $('#displayDetails').html(response);
        },
        error : (request,error) => {
           //  console.log("Request: %o", request.responseJSON);
            console.log("Request: %o", request);
        }
    });
}

// ############################### Create a celebrity sheet ################################# //

// const handleCreateForm = function (e) {
// const handleCreateForm = (e) => {
//     e.preventDefault();

//     const dataFromForm = new FormData(this);
//     fetch(`celebrities`,
//         {
//             method: "POST",
//             headers: new Headers({
//                 Accept: "application/json"
//             }),
//             body: {
//                 data: dataFromForm
//             }
//         }
//     )
//     .then((response) => {
//         if (response.ok) {
//             return response.json();
//         } else {
//             if (response.status === 403) {
//                 console.log('API rate limit exceeded.');
//                 throw new Error('API rate limit exceeded.');
//             } else {
//                 console.log('An error occurred.');
//                 throw new Error('An error occurred.');
//             }
//         }
//     })
//     .then((responseJson) => {
//         // Do something with the response
//         console.log("Data = %o", responseJson);
//         return responseJson;
//     })
//     .catch((error) => {
//         console.log(error)
//     });
// }

// document.querySelector("#createForm").addEventListener("submit", handleCreateForm);



// const handleCreateForm = function (e) {
//     e.preventDefault();

//     const data = new FormData(this);

//     axios
//         .post(this.action, data)
//         .then((res) => console.log(res))
//         .catch((err) => console.log(err));
// }

// document.querySelector("#createForm").addEventListener("submit", handleCreateForm);




const submitCelebritySheetBtn = $("#createCelebritySheet");

submitCelebritySheetBtn.click((e) => {
    e.preventDefault();

    let firstnameInputVal = $('input[name="firstname"]').val();
    let lastnameInputVal = $('input[name="lastname"]').val();
    let descriptionInputVal = $('input[name="description"]').val();
    // let imageInputVal = $('input[name="image"]').val();
    let imageInputVal = $('input[name="image"]').get(0).files[0];

    console.log(imageInputVal);

    if (firstnameInputVal !== null && firstnameInputVal !== "" 
        && lastnameInputVal !== null && lastnameInputVal !== "" 
        && descriptionInputVal !== null && descriptionInputVal !== ""
        && imageInputVal !== null && imageInputVal !== "" && imageInputVal !== undefined
    ) {
        console.log($('#createForm'));
        // let formData = new FormData($('#createForm')[0]);
        let formData = new FormData();

        formData.append('firstname', firstnameInputVal);
        formData.append('lastname', lastnameInputVal);
        formData.append('description', descriptionInputVal);
        // formData.append('image', imageInputVal, 'photo.jpg');
        formData.append('image', imageInputVal);

        console.log(formData);

        // let formDataStringified = JSON.stringify(formData);

        $.ajax({
            url: `celebrities`,
            type: 'POST',
            dataType: "json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            processData: false,
            contentType: false,
            data: formData,
            success: response => {
                // manageDeleteMessage();
                console.log("Form data sent to php");

                // location.reload()
                //  $("#celebrity_name_wrapper").html(`<h3 class="m-0 celebrity-h3 d-flex p-2" style="border:1px solid black"> <button onclick="getClickedCelebrity({{$celebrity->id}})" id="{{$celebrity->id}}" class="celebrities btn btn-link text-decoration-none text-dark w-100" name="{{$celebrity->id}}"> ${firstnameInputVal} ${lastnameInputVal} </button> <button onclick="deleteClickedCelebrity({{$celebrity->id}})" id="{{$celebrity->id}}" class="btn btn-danger">Delete</button> </h3>`);
            },
            error : (request,error) => {
            //  console.log("Request: %o", request.responseJSON);
                console.log("Request: %o", request);
            }
        });
    } else {
        alert("please, fill all the fields");
    }
});


// ############################### Update a celebrity sheet ################################# //
const updateClickedCelebrity = (id) => {

    const updateCelebritySheetBtn = $("#updateCelebritySheet");

    updateCelebritySheetBtn.click((e) => {
        e.preventDefault();

        let firstnameUpdateInputVal = $('input[name="firstname_update"]').val();
        let lastnameUpdateInputVal = $('input[name="lastname_update"]').val();
        let descriptionUpdateInputVal = $('input[name="description_update"]').val();
        let imageUpdateInputVal = $('input[name="image_update"]').get(0).files[0]; // check with undefined (not undefined)

        console.log(imageUpdateInputVal);

        if (firstnameUpdateInputVal !== null && firstnameUpdateInputVal != "" 
            && lastnameUpdateInputVal !== null && lastnameUpdateInputVal != "" 
            && descriptionUpdateInputVal !== null && descriptionUpdateInputVal != ""
            && imageUpdateInputVal !== null && imageUpdateInputVal != "" && imageUpdateInputVal != undefined
        ) {
            let updateformData = new FormData();

            updateformData.append('firstname_update', firstnameUpdateInputVal);
            updateformData.append('lastname_update', lastnameUpdateInputVal);
            updateformData.append('description_update', descriptionUpdateInputVal);
            updateformData.append('image_update', imageUpdateInputVal, 'photo.jpg');

            console.log(updateformData);

            $.ajax({
                url: `celebrities/update/${id}`,
                type: 'POST',
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                processData: false,
                contentType: false,
                data: updateformData,
                success: response => {
                    // manageDeleteMessage();
                    console.log("Form data sent to php");
                    console.log("id to update = %o", id);
                    
                    location.reload();
                    
                    // $("#celebrity_name_wrapper").html(`<h3 class="m-0 celebrity-h3 d-flex p-2" style="border:1px solid black"> <button onclick="getClickedCelebrity({{$celebrity->id}})" id="{{$celebrity->id}}" class="celebrities btn btn-link text-decoration-none text-dark w-100" name="{{$celebrity->id}}"> ${firstnameInputVal} ${lastnameInputVal} </button> <button onclick="deleteClickedCelebrity({{$celebrity->id}})" id="{{$celebrity->id}}" class="btn btn-danger">Delete</button> </h3>`);
                },
                error : (request,error) => {
                //  console.log("Request: %o", request.responseJSON);
                    console.log("Request: %o", request);
                }
            });
        } else {
            alert("please, fill all the fields");
        } 
    });
}

// ############################### delete a celebrity sheet ################################# //
const deleteClickedCelebrity = (id) => { // Function that handle through ajax the removal of one invoice by sending its ID to the backkend with the button located at the rigth of each invoice line
    if (confirm("Voulez vous vraiment supprimer cet élément ?")) { // alert that asks for confirmation before deliting a record
      $.ajax({
        url: `celebrities/delete/${id}`,
        type: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            _token: $("input[name=_token]").val()
        },
        success: response => {
            // $("#"+id).remove();
            $("#"+id).closest('.celebrity-h3').remove();
            manageDeleteMessage();
        },
        error : (request,error) => {
            //  console.log("Request: %o", request.responseJSON);
             console.log("Request: %o", request);
         }
        });
    }
}