let links = document.getElementsByName("precast");
let action = "./control/action.php";
let forms = "./control/forms.php";
let showData = _("show-data");
function cleanCkeditor(x) {
  return x.trim().length;
}
links.forEach(function (el) {
  el.onclick = function () {
    let id = el.id;
    showData.innerHTML =
      '<div class="text-center"> <i class="fa fa-spinner fa-spin fa-2x"></i></div>';

    if (id.trim().toLowerCase() === "create-precast") {
      //   SEND FOR PRECAST TITLE FORM
      $.ajax({
        url: "./control/forms.php",
        method: "POST",
        data: {
          precastTitleForm: "precastTitleForm",
        },
        beforeSend: function () {
          showData.innerHTML =
            '<div class="text-center"> <i class="fa fa-spinner fa-spin fa-2x"></i></div>';
        },
        success: function (data) {
          showData.innerHTML = data;
        },
      }).done(function () {
        let tForm = _("title-form");
        let titleInput = _("title");
        let btnTitle = _("btn-title");
        let error = _("error-title");
        CKEDITOR.replace(titleInput);
        // ON SUBMIT
        tForm.onsubmit = function (event) {
          event.preventDefault();
          var title = CKEDITOR.instances.title.getData();
          //   CHECK FOR EMPTY FIELDS
          if (cleanCkeditor(title) < 1) {
            error.innerHTML = error("ALL FIELDS REQUIRED");
            error.visibility = "visible";
          } else {
            error.innerHTML = loadIcon;
            error.visibility = "visible";
            // SEND TITLE
            $.ajax({
              url: "./control/action.php",
              method: "POST",
              data: {
                sendPrecastTitle: "sendPrecastTitle",
                title: title.trim(),
              },
              beforeSend: function () {
                btnTitle.disabled = true;
                btnTitle.innerHTML = `${loadIcon} Creating..`;
              },
              success: function (data) {
                btnTitle.disabled = false;
                btnTitle.innerHTML = "Create";
                error.innerHTML = data;
                error.visibility = "visible";
                console.log(data);
              },
            });
          }
        };
      });
    } else if (id.trim().toLowerCase() === "my-precasts") {
      // SEND FOR IT!

      $.ajax({
        url: action,
        method: "POST",
        data: {
          myPrecast: "myPrecast",
        },
        beforeSend: function () {},
        success: function (data) {
          showData.innerHTML = data;
        },
      }).done(function () {
        $("time.timeago").timeago();

        // DECLARE VERIABLES
        let edit = document.getElementsByName("edit-precast");
        let addContestant = document.getElementsByName("add-contestant");
        let showMyPrecast = _("show-myprecast-action");
        // PRECAST CONTESTANT
        addContestant.forEach(function (el) {
          el.onclick = function () {
            let id = el.id;
            // PRECAST CONTESTANT FORM
            $.ajax({
              url: forms,
              method: "POST",
              data: {
                contestantForm: "contestantForm",
                id: id,
              },
              beforeSend: function () {
                _(id).disabled = true;
                _(id).innerHTML = `${loadIcon} Loading`;
                showMyPrecast.innerHTML = `${loadIcon} Contestant Form... `;
              },
              success: function (data) {
                showMyPrecast.innerHTML = data;
              },
            }).done(function () {
              // CONTESTANT FORM GENERATE
              let form = _("form-contestant");
              let showForms = _("show-generated-form");
              let nOfContestant = _("nOfContestant");
              form.onsubmit = function (event) {
                event.preventDefault();
                showForms.innerHTML = "";

                nOfCV = nOfContestant.value;

                if (clean(nOfContestant) > 0) {
                  // GENERATE FORMS WITH TEXT AREA FORM UPLOAD BUTTON FOR IMAGES
                  let num = 1;
                  while (nOfCV > 0) {
                    showForms.innerHTML += `
                          <div class="contestant-form-container">
                           
                            <div class="form-group">
                              <label>  Contestant ${num} </label>
                              <input type="text" placeholder="Contestant Name" class="form-control">
                            </div>
                            <div class="form-group">
                              <label>Enter Contestant Biography</label>
                              <textarea class="form-control" placeholder="Contestant Profile" name="biography" id="bio-${num}"></textarea>
                            </div>
                            <div class="form-group">
                              <input type="file" name="" id="" class="file" multiple>
                            </div>
                          </div>`;

                    nOfCV -= 1;
                    num++;
                  }

                  let bioField = document.getElementsByName("biography");

                  bioField.forEach(function (el) {
                    let bio = el.id;
                    CKEDITOR.replace(`${bio}`);
                  });
                } else if (typeof nOfContestant.value !== "number") {
                  showForms.innerHTML = "INVALID VALUE";
                } else {
                  showForms.innerHTML = info("ALL FIELDS REQUIRED");
                }
              };
            });
          };
        });

        // EDIT PRECAST
        edit.forEach(function (el) {
          el.onclick = function () {
            let id = el.id;
            console.log(id);
          };
        });
      });
    }
  };
});
