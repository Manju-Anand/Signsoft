<?php  if (count($errors) > 0) : ?>
<div class="alert alert-danger border-0 bg-danger alert-dismissible fade show py-2">
									<div class="d-flex align-items-center">
										<div class="font-35 text-white"><i class='bx bxs-message-square-x'></i>
										</div>
										<div class="ms-3">
											<?php foreach ($errors as $error) : ?>
												<p><?php echo $error ?></p>
											<?php endforeach ?>
										</div>
									</div>
									<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
								</div>
<?php  endif ?>
