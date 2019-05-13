$(document).ready(function() {
   let controller = "product";
   let wasEdited = false;

   if (!$("#slug").val()) $("#slug").hide();

   $("#save-slug").hide();
   $("#reset-slug").hide();
   $("#slug-edit-field").hide();
   $("#name").on("keyup", function() {
      if (!wasEdited) {
         let title = $("#name").val();
         setSlug(title);
      }
   });

   $("#edit-slug").on("click", function() {
      $("#slug").hide();
      $("#save-slug").show();
      $("#edit-slug").hide();
      $("#reset-slug").show();
      $("#slug-edit-field").show();
      editSlug();
   });

   $("#save-slug").on("click", function() {
      $("#slug").show();
      $("#save-slug").hide();
      $("#edit-slug").show();
      $("#reset-slug").hide();
      $("#slug-edit-field").hide();
      saveSlug();
   });

   $("#reset-slug").on("click", function() {
      $("#slug").hide();
      $("#save-slug").hide();
      $("#edit-slug").show();
      $("#reset-slug").hide();
      $("#slug-edit-field").hide();
      resetSlug();
   });

   function setSlug(title, count = 0) {
      let slug = Slug(title + (count > 0 ? `-${count}` : ""));
      setSlugIfSlugUnique(slug, controller, count);
   }

   function editSlug() {
      let existingSlug = $("#slug")
         .val()
         .trim();
      $("#slug-edit-field").val(existingSlug);
   }

   function saveSlug() {
      wasEdited = true;
      let newTitle = $("#slug-edit-field").val();
      setSlug(newTitle);
   }

   function resetSlug() {
      wasEdited = false;
      $("#slug").val("");
   }

   function setSlugIfSlugUnique(slug, controller, count) {
      if (window.Laravel.apiToken && slug) {
         axios
            .get(`/api/${controller}/unique`, {
               params: {
                  api_token: window.Laravel.apiToken,
                  slug: slug
               }
            })
            .then(function(response) {
               if (response.data) {
                  $("#slug").show();
                  $("#slug").val(slug);
                  $("#slug").css("width", $("#slug").val().length + 1.5 + "ch");
               } else {
                  let title = wasEdited
                     ? $("#slug-edit-field").val()
                     : $("#name").val();
                  setSlug(title, count + 1);
               }
            })
            .catch(function(error) {
               console.log(error);
            });
      }
   }
});
