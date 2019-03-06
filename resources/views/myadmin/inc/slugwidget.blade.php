<div class="slug-widget">
   <div class="url-wrapper wrapper">
      <i class="fa fa-link"></i>&nbsp;
      <span class="root-url">{{url('/')}}</span>
      <span class="subdirectory-url">/product/</span>
      <span class="slug" id="slug"></span>&nbsp;
      <input type="text" name="slug-edit" class="slug-edit-field" id="slug-edit-field" v-show="isEditing" v-model="customSlug">&nbsp;
      <span style="margin-top:4px;">
         <span id="edit-slug" class="btn btn-default slug-btn">Edit</span>
         <span id="save-slug" class="btn btn-default slug-btn">Save</span>
         <span id="reset-slug" class="btn btn-default slug-btn">Reset</span>
      </span>
   </div>
</div>