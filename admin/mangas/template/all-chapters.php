<?php 
$chapter_query = 'SELECT * FROM chapter WHERE manga_id =' . $id . ' ORDER BY volume+0 ASC';
$chapter_result = mysqli_query($connection, $chapter_query);

?>

<table id="example" class="table table-striped" style="width:100%">
          <thead>
               <tr>
                    <th style='width:50px'>ID</th>
                    <th style='width:80px'>Avatar</th>
                    <th style='width:50px'>Volume</th>
                    <th>Title</th>
                    <th>Status</th>
                    <th style='width:120px'></th>
               </tr>
          </thead>
          <tbody>
          <?php while($chapter_row = mysqli_fetch_assoc($chapter_result)){ 
                         $chapter_id = $chapter_row['id'];
                         $chapter_title =  $chapter_row['title'];
                         $chapter_status =  $chapter_row['status'];
                         $chapter_volume =  $chapter_row['volume'];
                         $chapter_hash =  $chapter_row['hash'];
                         $chapter_cover =  $chapter_row['cover'];
          ?>
          <tr>
               <td><?php echo $chapter_id ?></td>
               <td id='imgcnter'><img style='width:50px;height:50px;object-fit:cover' src="<?php if(empty($chapter_cover)){echo '/admin/uploads/no-image.png';}else{?>/admin/uploads/<?php echo $hash.'/chapters/'.$chapter_hash.'/'.$chapter_cover; }?>" alt="cover image"></td>
               <td><?php echo $chapter_volume ?></td>
               <td><?php echo $chapter_title ?></td>
               <td><?php echo $chapter_status ?></td>
               
               <td style='height:40px;display:flex;justify-content:space-around;display:block'>
                    <a style='' href="/admin/mangas/single-chapter.php?id=<?php echo $chapter_id; ?>"><i class="fa-l fa-xl fas fa-fw fa-pen"></i></a>
                    <?php if($_SESSION['role'] > 3){?>
                    <a type="button" class="" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $chapter_id ?>">
                    <i class="fa-xl fas fa-fw fa-trash"></i>
                    </a>
                    <?php };?>

               </td>
          </tr>

               <?php if($_SESSION['role'] > 3){?>

               <!-- Delete Modal -->
               <div class="modal fade" id="deleteModal<?php echo $chapter_id ?>" tabindex="1" aria-labelledby="deleteModal<?php echo $chapter_id ?>Label" aria-hidden="true">
               <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="deleteModal<?php echo $chapter_id ?>Label">Delete <?php echo $chapter_title ?></h5>
                    <a type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></a>
                    </div>
                    <div class="modal-body">
                    Are you sure to delete <?php echo $chapter_title ?>?
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <form method='POST' action="./code/delete-chapter.php" enctype="multipart/form-data">
                         <input type="hidden" value="<?php echo $chapter_id ?>" name='id'>
                         <input type="hidden" value="<?php echo $id ?>" name='manga_id'>
                         <input type="hidden" value="<?php echo $chapter_hash ?>" name='hash'>
                         <input type="hidden" value="<?php echo $hash ?>" name='manga_hash'>
                         <button type='submit' type="button" name='deleteChapter' class="btn btn-danger">Delete</button>
                    </form>
                    </div>
                    </div>
               </div>
               </div>

               <?php }; ?>
          <?php } ?>

          </tbody>
     </table>



<style>   
    #imgcnter {width:50px;height:50px;object-fit: cover;}
    #imgcnter img{width:100%;height:100%;object-fit: cover;}
</style>


    <!-- Bootstrap core JavaScript-->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script>new DataTable('#example');</script>
    <?php include('../includes/footer.php'); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
