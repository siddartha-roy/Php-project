<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
    .form {
        border: 2px solid;
        padding: 1rem;
        border-radius: 8px;
    }
    </style>

    <title>Notes App</title>
</head>

<body>
    <?php include"./navbar.php";?>
    <?php include"./db.php";?>
    <?php include"./edit.php";?>
    <?php
    if(isset($_POST["submit"])){
        if(!isset($_POST["hidden"])){
        $title=$_POST["title"];
        $desc=$_POST["desc"];
        $sql="INSERT INTO `notes`( `title`, `description`) VALUES ('$title','$desc')";
        $res=mysqli_query($conn,$sql);
        }
       
    }
    ?>
    <div class="container my-3">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <form class="form" method="POST">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" placeholder="Enter Title" name="title">

                    </div>
                    <div class="mb-3">
                        <label for="desc" class="form-label">Description</label>
                        <textarea class="form-control" id="desc" rows="3" placeholder="Enter Description"
                            name="desc"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary" name="submit">Add Note</button>
                </form>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <h1>Your Notes</h1>
                <?php
                  $sql="SELECT * FROM `notes`";
                  $res=mysqli_query($conn,$sql);
                  $noNotes=true;
                  while($fetch=mysqli_fetch_assoc($res)){
                      $noNotes=false;
                      echo '<div class="card">
                     
                      <div class="card-body">
                        <h5 class="card-title">'.$fetch["title"].'</h5>
                        <p class="card-text">'.$fetch["description"].'</p>
                        <button type="button" class="btn btn-primary edit" data-bs-toggle="modal" data-bs-target="#exampleModal" id="'.$fetch["sno"].'" >
                         Edit
                        </button>
                        <a href="./delete.php?id='.$fetch["sno"].'" class="btn btn-danger">Delete</a>
                      </div>
                    </div>';
                  }
                  if($noNotes)
                  {
                      echo '<div class="card">
                     
                      <div class="card-body">
                        <h5 class="card-title">Message</h5>
                        <p class="card-text">No Notes</p>
                        
                      </div>
                    </div>';
                  }

                ?>

            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <script>
        const edit=document.querySelectorAll(".edit");
        const editTitle=document.getElementById("edittitle");
        const editdesc=document.getElementById("editdesc");
        const hiddenInput=document.getElementById("hidden");
        const cardBody=document.querySelectorAll(".card-body");

        edit.forEach(element=>{
            element.addEventListener("click",()=>{
                
               const titletext=element.parentElement.children[0].innerText;
                const descText=element.parentElement.children[1].innerText;
                editTitle.value=titletext;
                editdesc.value=descText;
                hiddenInput.value=element.id;

            });
        });

        const search=document.getElementById('search');
        search.addEventListener("input",()=>{
            const value=search.value.toLowerCase();
            console.log(value);
            cardBody.forEach(element=>{
                const titletext=element.children[0].innerText.toLowerCase();
                const descText=element.children[1].innerText.toLowerCase();
                if(titletext.includes(value) || descText.includes(value)){
                    element.parentElement.style.display="block";
                    //console.log("yes");

                }else {
                    //console.log("no");
                    element.parentElement.style.display="none"; 
                }

            });



            
        });




    </script>


</body>

</html>