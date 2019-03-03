<script type="text/x-template" id="files-template">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <div class="input-group">
                    <input type="text" class="form-control form-control-sm" v-model="pencarian">
                    <div class="input-group-append">
                        <button class="btn btn-secondary btn-sm" @click="doPencarian()">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                    <div class="input-group-append">
                        <button class="btn btn-success btn-sm" @click="refresh()">
                            <i class="fa fa-refresh"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li v-if="breadcrumb_loading">
                        <i class="fa fa-refresh fa-spin"></i>
                    </li>
                    <li v-else v-for="(breadcrumb, index) in breadcrumbs" class="breadcrumb-item">
                        <template v-if="index == (breadcrumbs.length - 1)">
                            <span>@{{breadcrumb.name}}</span>
                        </template>
                        <template v-if="index != (breadcrumbs.length - 1)">
                            <a href="javascript:void(null)" @click="folderClick(breadcrumb)">@{{breadcrumb.name}}</a>
                        </template>
                    </li>
                </ol>
            </nav>
        </div>
        <div style="height : 300px; overflow : scroll; width : 100%">
            <div class="col-md-12 text-left">
                <div class="card">
                    <div class="card-header bg-secondary text-white">
                        Folder
                        <span class="float-right">
                            <div class="input-group" v-if="new_folder">
                                <input type="text" class="form-control form-control-sm" v-model="folder_name">
                                <div class="input-group-append" @click="folderSave()">
                                    <button class="btn btn-primary btn-sm">
                                        <i class="fa fa-save"></i>
                                    </button>
                                </div>
                                <div class="input-group-append">
                                    <button class="btn btn-danger btn-sm" @click="new_folder = false">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <button class="btn btn-success btn-sm" v-else @click="new_folder = true">
                                <i class="fa fa-folder-o"></i>
                            </button>
                        </span>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div :class="(folder_details) ? 'col-md-8' : 'col-md-12' ">
                                <center v-if="folders_loading">
                                    <i class="fa fa-refresh fa-spin"></i>
                                </center>
                                <div v-if="!folders_loading">
                                    <div class="btn-group mt-2 mr-2 " v-for="(folder, index) in folders"
                                        v-if="folders.length > 0">
                                        <button class="btn btn-light" @click="folderClick(folder)">
                                            <i class="fa fa-folder"></i> @{{folder.name}}
                                        </button>
                                        <div class="dropdown">
                                            <button class="btn btn-light dropdown-toggle" type="button"
                                                :id="'dropdownMenuButton'+index" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                            </button>
                                            <div class="dropdown-menu" :aria-labelledby="'dropdownMenuButton'+index">
                                                <a class="dropdown-item" href="javascript:void(null)"
                                                    @click="folderDelete(folder)"><i class="fa fa-trash"></i> Delete</a>
                                                <a class="dropdown-item" href="javascript:void(null)"
                                                    @click="folderRename(folder)"><i class="fa fa-pencil"></i> Rename</a>
                                                <a class="dropdown-item" href="javascript:void(null)"
                                                    @click="folderDetails(folder)"><i class="fa fa-eye"></i> Details</a>
                                            </div>
                                        </div>
                                    </div>
                                    <center v-if="folders.length == 0">
                                        <span>
                                            Empty
                                        </span>
                                    </center>
                                </div>
                            </div>
                            <div class="col-md-4" v-show="folder_details">
                                <div class="card">
                                    <div class="card-header">

                                        <div class="row">
                                            <div class="col-md-12">
                                                Name : @{{folder.name}}
                                            </div>
                                            <div class="col-md-12">
                                                Upload data-id : @{{folder.id}}
                                            </div>
                                            <div class="col-md-12">
                                                <a href="javascript:void(null)" class="btn btn-danger btn-sm"
                                                    @click="folder_details = false">
                                                    <i class="fa fa-times"></i> Close
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 text-left mt-2">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        File
                        <span class="float-right">
                            <button class="btn btn-success btn-sm" @click="fileUpload()">
                                <i class="fa fa-upload"></i>
                            </button>
                        </span>
                    </div>
                    <div class="card-body">
                        <center v-if="files_loading">
                            <i class="fa fa-refresh fa-spin"></i>
                        </center>
                        <div v-if="!files_loading">
                            <div class="row">
                                <div class="mb-2 mr-2 ml-2" v-for="(file, index) in files">
                                    <a href="javascript:void(null)" @click="fileSelect(file)">
                                        <img :src="getThumbnail(file)" alt="" style="height : 150px; width : 150px">
                                    </a>
                                    <div class="dropdown">
                                        <button class="btn btn-light dropdown-toggle" type="button"
                                            :id="'dropdownMenuButton'+index" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false" style="font-size : 10px; width : 150px; overflow : hidden">
                                            @{{file.name}}
                                        </button>
                                        <div class="dropdown-menu" :aria-labelledby="'dropdownMenuButton'+index">
                                            <a class="dropdown-item" href="javascript:void(null)"
                                                @click="fileDelete(file)"><i class="fa fa-trash"></i> Delete</a>
                                            <a class="dropdown-item" href="javascript:void(null)"
                                                @click="fileRename(file)"><i class="fa fa-pencil"></i> Rename</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <center v-if="files.length == 0">
                                <span>
                                    Empty
                                </span>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal" id="modal-delete">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Delete</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        Are you sure?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                        <button type="button" class="btn btn-primary" @click="confirmationDelete()">Yes</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal" id="modal-rename">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Rename</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <input type="text" class="form-control" v-model="modal_rename.name">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" @click="confirmationRename()">Save</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal" id="modal-upload">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Upload</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div v-if="file_to_upload.length == 0">
                                    <form enctype="multipart/form-data">
                                        <input type="file" multiple
                                            @change="filesChange($event.target.name, $event.target.files); file_count = $event.target.files.length"
                                            style="opacity : 0; width: 100%;
                                            height: 50px;
                                            position: absolute;
                                            cursor: pointer;">
                                        <button class="btn btn-secondary" @click="">
                                            Pilih file yang ingin diupload
                                        </button>
                                    </form>
                                </div>
                                <div v-else>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>
                                                    Filename
                                                </th>
                                                <th>
                                                    Progress
                                                </th>
                                                <th>
                                                    Action
                                                </th>
                                            </tr>
                                        </thead>
                                        <tr v-for="(file, index) in file_to_upload">
                                            <td style="text-align : left" width="70%">
                                                @{{file.file.name}} @{{parseInt(file.file.size/1024)}} kb
                                            </td>
                                            <td width="25%">
                                                <div class="progress" v-if="file.progress < 100">
                                                    <div class="progress-bar bg-success progress-bar-striped progress-bar-animated"
                                                        role="progressbar" v-bind:aria-valuenow="file.progress"
                                                        aria-valuemin="0" aria-valuemax="100"
                                                        v-bind:style="{width : file.progress+'%'}"></div>
                                                </div>
                                                <i class="fa fa-check text-success" v-if="file.progress == 100"></i>
                                            </td>
                                            <td width="5%">
                                                <a href="javascript:void(null)" @click="removeFileToUpload(index)">
                                                    <i class="fa fa-times text-danger"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" @click="confirmUpload()">Upload</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</script>
<script>
    const Files = {
        template: '#files-template',
        data() {
            return {
                files: [],
                folders: [],
                breadcrumbs: [],
                files_loading: false,
                folders_loading: false,
                breadcrumb_loading: false,
                active: { id: 0 },
                new_folder: false,
                folder_name: '',
                folder_details: false,
                folder: {},
                modal_rename: {},
                modal_delete: {},
                file_to_upload: [],
                file_count: 0,
                pencarian: '',
            }
        },

        watch: {
            file_to_upload: function () {
                let complete = true;
                this.file_to_upload.map((file) => {
                    if (file.progress != 100) {
                        complete = false;
                    }
                })
                if (complete && this.file_to_upload.length > 0) {
                    $('#modal-upload').modal('hide');
                    this.loadFile(this.active);
                }
            }
        },

        methods: {
            loadFile: function (active) {
                this.files_loading = true;
                fetch('{{config("fileman.fileman_host")}}/api/files?token=' + accessToken, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        active: active,
                        pencarian: this.pencarian
                    })
                }).then(response => response.json())
                    .then(responseJson => {
                        console.log(responseJson);
                        this.files = responseJson;
                        this.files_loading = false;
                    })
            },

            loadFolder: function (active) {
                this.folders_loading = true;
                fetch('{{config("fileman.fileman_host")}}/api/folders?token=' + accessToken, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        active: active,
                        pencarian: this.pencarian
                    })
                }).then(response => response.json())
                    .then(responseJson => {
                        this.folders = responseJson;
                        this.folders_loading = false;
                    })
            },

            loadBreadcrumb: function (active) {
                this.breadcrumb_loading = true;
                fetch('{{config("fileman.fileman_host")}}/api/breadcrumbs?token=' + accessToken, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        active: active
                    })
                }).then(response => response.json())
                    .then(responseJson => {
                        this.breadcrumbs = responseJson;
                        this.breadcrumb_loading = false;
                        console.log(this.breadcrumbs);
                    })
            },

            folderClick: function (folder) {
                this.active = folder;
                this.loadFolder(folder);
                this.loadFile(folder);
                this.loadBreadcrumb(folder);
                this.folder_details = false;
            },

            folderSave: function () {
                if (this.folder_name == '') {
                    return false
                }
                fetch('{{config("fileman.fileman_host")}}/api/folders/save?token=' + accessToken, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        active: this.active,
                        folder_name: this.folder_name
                    })
                }).then(response => {
                    let json = response.json();
                    if (response.status != 200) {
                        let error = json.then((res) => {
                            alert(res.message);
                        })
                    }
                    return json;
                }).then(responseJson => {
                    this.loadFolder(this.active);
                    this.folder_name = '';
                }).catch(response => {
                    console.log('a');
                })
            },

            folderDetails: function (folder) {
                this.folder_details = true;
                this.folder = folder;
            },

            folderDelete: function (folder) {
                this.modal_delete = folder;
                $('#modal-delete').modal('show');
            },
            fileDelete: function (file) {
                this.modal_delete = file;
                $('#modal-delete').modal('show');
            },

            folderRename: function (folder) {
                this.modal_rename = folder;
                $('#modal-rename').modal('show').on('hidden.bs.modal', () => {
                    this.loadFolder(this.active);
                });
            },
            fileRename: function (file) {
                this.modal_rename = file;
                $('#modal-rename').modal('show').on('hidden.bs.modal', () => {
                    this.loadFolder(this.active);
                });
            },

            confirmationDelete: function () {
                $('#modal-delete').modal('hide');
                let url = '{{config("fileman.fileman_host")}}/api/folders';
                if (this.modal_delete.is_file == 1) {
                    url = '{{config("fileman.fileman_host")}}/api/files';
                }

                fetch(url + '/delete?token=' + accessToken, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        folder: this.modal_delete
                    })
                }).then(response => {
                    let json = response.json();
                    if (response.status != 200) {
                        let error = json.then((res) => {
                            alert(res.message);
                        })
                    }
                    return json;
                }).then(responseJson => {
                    this.loadFolder(this.active);
                    this.loadFile(this.active);
                }).catch(response => {
                    console.log('a');
                })
            },

            confirmationRename: function () {
                $('#modal-rename').modal('hide');
                fetch('{{config("fileman.fileman_host")}}/api/folders/rename?token=' + accessToken, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        folder: this.modal_rename
                    })
                }).then(response => {
                    let json = response.json();
                    if (response.status != 200) {
                        let error = json.then((res) => {
                            alert(res.message);
                        })
                    }
                    return json;
                }).then(responseJson => {
                    this.loadFolder(this.active);
                    this.loadFile(this.active);
                }).catch(response => {
                    console.log('a');
                })
            },

            getThumbnail: function (file) {
                if (file.type == 'image/png' || file.type == 'image/jpg' || file.type == 'image/gif' || file.type == 'image/jpeg' || file.type == 'image/bmp') {
                    return '{{config("fileman.fileman_host")}}' + file.url;
                }
            },

            fileUpload: function () {
                this.file_to_upload = [];
                $('#modal-upload').modal('show');
            },
            filesChange: function (fieldName, fileList) {
                if (!fileList.length) return;
                $.each(fileList, (index, file) => {
                    this.file_to_upload.push({ file: file, progress: 0 });
                })
                console.log(this.file_to_upload);
            },

            removeFileToUpload: function (index) {
                this.file_to_upload.splice(index, 1);
            },

            confirmUpload: function () {
                this.file_to_upload.map((file, index) => {
                    var file_to_upload = this.file_to_upload;
                    var formData = new FormData();
                    formData.append('image', file.file, file.file.name);
                    formData.append('active', JSON.stringify(this.active));
                    let ajax = window.$;
                    ajax.ajax({
                        xhr: function () {
                            var xhr = new window.XMLHttpRequest();
                            xhr.upload.addEventListener("progress", function (evt) {
                                if (evt.lengthComputable) {
                                    var percentComplete = evt.loaded / evt.total;
                                    file_to_upload[index].progress = parseInt(percentComplete * 100);
                                    file_to_upload.push({});
                                    file_to_upload.pop();
                                }
                            }, false);
                            return xhr;
                        },
                        headers: {
                            Accept: 'application/json'
                        },
                        url: '{{config("fileman.fileman_host")}}/api/files/upload?token=' + accessToken,
                        data: formData,
                        type: 'POST',
                        cache: false,
                        contentType: false,
                        enctype: 'multipart/form-data',
                        processData: false,
                        success: function (data) {
                            console.log('A');
                        }
                    });
                });
                this.file_to_upload.push({});
                this.file_to_upload.pop();
            },

            refresh: function () {
                this.pencarian = '';
                this.loadFile(this.active);
                this.loadFolder(this.active);
                this.loadBreadcrumb(this.active);
            },

            doPencarian: function () {
                this.loadFile(this.active);
                this.loadFolder(this.active);
                this.loadBreadcrumb(this.active);
            },
            fileSelect: function (file) {
                input = '';
                if (this.$route.query.input != null) {
                    input = this.$route.query.input;
                }
                if (input == '') {
                    return;
                }
                parent.$('body').find('#' + input).val('{{config("fileman.fileman_host")}}' + file.url);
                parent.$('#modal-fileman').modal('hide');
            }

        },
        mounted() {
            id = 0;
            if (this.$route.query.id != null) {
                id = this.$route.query.id;
            }
            this.loadFile({ id: id });
            this.loadFolder({ id: id });
            this.loadBreadcrumb({ id: id });

        }
    }
</script>