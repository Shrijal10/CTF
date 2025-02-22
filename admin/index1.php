<?php
include('includes/header.php');
#include('includes/topbar.php');
// include('includes/sidebar.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CTF Names</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6 mt-5 text-center">
            <h1>CTF Names</h1>
            <form action="index.php" method="POST" class="mt-5">
                <fieldset class="text-center">
                    <legend>Select Existing Names</legend>
                    <div class="form-group">
                        <label for="selected_names">Enter existing names</label>
                        <div class="text-center">
                            <input type="text" id="selected_names" name="selected_names" class="form-control mx-auto" maxlength="100" style="max-width:500px;">
                        </div>
                    </div>
                </fieldset>
                <fieldset class="text-center mt-4">
                    <legend>Enter New Names</legend>
                    <div class="form-group">
                        <label for="new_names">Enter new names</label>
                        <input type="text" id="new_names" name="new_names" class="form-control mx-auto" maxlength="100" style="max-width:500px;">
                    </div>
                </fieldset>
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-primary" style="max-width:200px;">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>

<script>
    $(document).ready(function() {
        // Fetch existing CTF names and populate the dropdown
        function fetchCTFNames() {
            $.ajax({
                url: "includes/functions.php",
                method: "POST",
                data: { action: "fetchCTFNames" },
                success: function(response) {
                    try {
                        var jsonResponse = JSON.parse(response);
                        if (jsonResponse.success) {
                            var dropdown = $("#existingCTF");
                            dropdown.empty();
                            dropdown.append('<option value="">Select Existing CTF</option>');
                            $.each(jsonResponse.data, function(index, item) {
                                dropdown.append('<option value="' + item.Names + '">' + item.Names + '</option>');
                            });
                        } else {
                            console.error(jsonResponse.message);
                        }
                    } catch (e) {
                        alert("Error parsing JSON response: " + e.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error("AJAX Error: " + status + " - " + error);
                    alert("An error occurred. Please try again.");
                }
            });
        }

        fetchCTFNames(); // Load existing CTF names on page load

        $("#createCTFButton").click(function() {
            var ctfName = $("#ctfName").val().trim();
            var selectedCTF = $("#existingCTF").val();

            if (selectedCTF) {
                // Handle existing CTF name selection (if needed)
                alert("Selected existing CTF: " + selectedCTF);
                location.href = "index.php"; // Redirect after handling existing CTF
            } else if (ctfName !== "") {
                $.ajax({
                    url: "includes/functions.php",
                    method: "POST",
                    data: { ctfName: ctfName, action: "createCTF" },
                    success: function(response) {
                        try {
                            var jsonResponse = JSON.parse(response);
                            if (jsonResponse.success) {
                                alert(jsonResponse.message);
                                location.href = "index.php"; // Redirect after successful addition
                            } else {
                                alert(jsonResponse.message);
                            }
                        } catch (e) {
                            alert("Error parsing JSON response: " + e.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("AJAX Error: " + status + " - " + error);
                        alert("An error occurred. Please try again.");
                    }
                });
            } else {
                alert("Please enter a valid CTF name.");
            }
        });
    });
</script>

