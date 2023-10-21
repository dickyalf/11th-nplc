 <!-- Profile -->
 <div class="block pull-x">
     <div class="block-header bg-body-light">
         <h3 class="block-title">
             <i class="fa fa-fw fa-pencil-alt opacity-50 me-1"></i> Profile
         </h3>
         <div class="block-options">
             <button type="button" class="btn-block-option" data-toggle="block-option"
                 data-action="content_toggle"></button>
         </div>
     </div>
     <div class="block-content block-content-full">
         <form wire:submit.prevent='updateProfile'>
             <div class="mb-3">
                 <label class="form-label" for="side-overlay-profile-name">Name</label>
                 <div class="input-group">
                     <input type="text" class="form-control"
                         id="side-overlay-profile-name" name="side-overlay-profile-name" placeholder="Your name.."
                         wire:model='user.name'>
                     <span class="input-group-text">
                         <i class="fa fa-user"></i>
                     </span>
                     @error('user.name')
                         <div class="invalid-feedback">
                             {{ $message }}
                         </div>
                     @enderror
                 </div>
             </div>
             <div class="mb-3">
                 <label class="form-label" for="side-overlay-profile-email">Email</label>
                 <div class="input-group">
                     <input type="email" class="form-control" id="side-overlay-profile-email"
                         name="side-overlay-profile-email" placeholder="Your email.." wire:model='user.email'>
                     <span class="input-group-text">
                         <i class="fa fa-envelope"></i>
                     </span>
                 </div>
             </div>
             <div class="mb-3">
                 <label class="form-label" for="old_pass">Old Password</label>
                 <div class="input-group">
                     <input type="password" class="form-control" id="old_pass" name="old_pass"
                         placeholder="New Password.." wire:model='old_password'>
                     <span class="input-group-text">
                         <i class="fa fa-asterisk"></i>
                     </span>
                 </div>
             </div>
             <div class="mb-3">
                 <label class="form-label" for="side-overlay-profile-password">New Password</label>
                 <div class="input-group">
                     <input type="password" class="form-control" id="side-overlay-profile-password"
                         name="side-overlay-profile-password" placeholder="New Password.." wire:model='password'>
                     <span class="input-group-text">
                         <i class="fa fa-asterisk"></i>
                     </span>
                 </div>
             </div>
             <div class="mb-3">
                 <label class="form-label" for="side-overlay-profile-password-confirm">Confirm New
                     Password</label>
                 <div class="input-group">
                     <input type="password" class="form-control" id="side-overlay-profile-password-confirm"
                         name="side-overlay-profile-password-confirm" placeholder="Confirm New Password.."
                         wire:model='confirm_password'>
                     <span class="input-group-text">
                         <i class="fa fa-asterisk"></i>
                     </span>
                 </div>
             </div>
             <div class="row">
                 <div class="col-6">
                     <button type="submit" class="btn btn-alt-primary">
                         <i class="fa fa-sync opacity-50 me-1"></i> Update
                     </button>
                 </div>
             </div>
         </form>
     </div>
 </div>
 <!-- END Profile -->
