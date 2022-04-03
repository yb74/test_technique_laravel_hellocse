const manageDeleteMessage = () => { // function that display a message when a record is deleted with success and remove it after 5 seconds
    $('span.js-delete-msg').html('<div class="alert alert-danger alert-dismissible fade show text-center">"The celebrity sheet has been deleted."</div>');
    setTimeout(() => {$('span.js-delete-msg').html(" ")}, 5000);
    $(window).scrollTop(0);
}

const manageCreateMessage = () => { // function that display a message when a record is created with success and remove it after 5 seconds
    $('span.js-delete-msg').html('<div class="alert alert-success alert-dismissible fade show text-center">"The celebrity sheet has been created."</div>');
    setTimeout(() => {$('span.js-delete-msg').html(" ")}, 5000);
    $(window).scrollTop(0);
}

const manageUpdateMessage = () => { // function that display a message when a record is updated with success and remove it after 5 seconds
    $('span.js-delete-msg').html('<div class="alert alert-warning alert-dismissible fade show text-center">"The celebrity sheet has been updated."</div>');
    setTimeout(() => {$('span.js-delete-msg').html(" ")}, 5000);
    $(window).scrollTop(0);
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

            $('#displayDetails').html(response);
        },
        error : (request,error) => {
            console.log("Request: %o", request);
        }
    });
    $(window).scrollTop(0);
}

// ############################### Create a celebrity sheet ################################# //

const submitCelebritySheetBtn = $("#createCelebritySheet");

submitCelebritySheetBtn.click((e) => {
    e.preventDefault();

    let firstnameInputVal = $('input[name="firstname"]').val();
    let lastnameInputVal = $('input[name="lastname"]').val();
    let descriptionInputVal = $('input[name="description"]').val();
    let imageInputVal = $('input[name="image"]').get(0).files[0];

    console.log(imageInputVal);

    if (firstnameInputVal !== null || firstnameInputVal !== "" 
        || lastnameInputVal !== null || lastnameInputVal !== "" 
        || descriptionInputVal !== null || descriptionInputVal !== ""
        || imageInputVal !== null || imageInputVal !== "" || imageInputVal !== undefined
    ) {
        console.log($('#createForm'));
        let formData = new FormData();

        formData.append('firstname', firstnameInputVal);
        formData.append('lastname', lastnameInputVal);
        formData.append('description', descriptionInputVal);
        formData.append('image', imageInputVal);

        console.log(formData);

        $.ajax({
            url: `celebrities`,
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            processData: false,
            contentType: false,
            data: formData,
            success: response => {
                console.log("Form data sent to php");
                location.reload();
                manageCreateMessage();
            },
            error : (request,error) => {
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
        let imageUpdateInputVal = $('input[name="image_update"]').get(0).files[0];

        console.log(imageUpdateInputVal);

        if (firstnameUpdateInputVal !== null || firstnameUpdateInputVal != "" 
            || lastnameUpdateInputVal !== null || lastnameUpdateInputVal != "" 
            || descriptionUpdateInputVal !== null || descriptionUpdateInputVal != ""
            || imageUpdateInputVal !== null || imageUpdateInputVal != "" && imageUpdateInputVal != undefined
        ) {
            let updateformData = new FormData();

            updateformData.append('firstname_update', firstnameUpdateInputVal);
            updateformData.append('lastname_update', lastnameUpdateInputVal);
            updateformData.append('description_update', descriptionUpdateInputVal);
            updateformData.append('image_update', imageUpdateInputVal);

            console.log(updateformData);

            $.ajax({
                url: `celebrities/update/${id}`,
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                processData: false,
                contentType: false,
                data: updateformData,
                success: response => {
                    console.log("Form data sent to php");
                    console.log("id to update = %o", id);
                    location.reload();   
                    manageUpdateMessage();               
                },
                error : (request,error) => {
                    console.log("Request: %o", request);
                }
            });
        } else {
            alert("please, fill all the fields");
        } 
    });
}

// ############################### delete a celebrity sheet ################################# //
const deleteClickedCelebrity = (id) => { // Function that handle through ajax the removal of one element by sending its ID to the backkend
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
            $("#"+id).closest('.celebrity-h3').remove();
            $("#celebrity_text_and_picture_container").remove();
            manageDeleteMessage();
        },
        error : (request,error) => {
             console.log("Request: %o", request);
         }
        });
    }
}
