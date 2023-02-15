<template>
    <div id="app">
        <!-- <ckeditor :editor="editor" v-model="editorData" :config="editorConfig"></ckeditor>  -->
    </div>
</template>


<script>
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';



export default {
    name: 'CK Editor',
    // data() {
    //     return {
    //         editor: ClassicEditor,
    //         editorData: '<p>Content of the editor.</p>',
    //         editorConfig: {
    //             // The configuration of the editor.
    //         }
    //     };
    // },
    mounted() {
        ClassicEditor
            .create(document.querySelector('#newsText'),
                {
                    extraPlugins: [MyCustomUploadAdapterPlugin],
                })
            .catch(error => {
                console.error(error);
            });
        console.log('CKEditor component mounted.')
    }
}


class MyUploadAdapter {
    constructor(loader) {
        this.loader = loader;
    }

    upload() {
        return this.loader.file
            .then(file => new Promise((resolve, reject) => {
                this._initRequest();
                this._initListeners(resolve, reject, file);
                this._sendRequest(file);
            }));
    }

    abort() {
        if (this.xhr) {
            this.xhr.abort();
        }
    }

    _initRequest() {
        const xhr = this.xhr = new XMLHttpRequest();
        
        xhr.open('POST', "/file-manager/upload?_token="+document.querySelector("#newsEditor input[name='_token']").value, true);
        xhr.responseType = 'json';
    }

    _initListeners(resolve, reject, file) {
        const xhr = this.xhr;
        const loader = this.loader;
        const genericErrorText = `Couldn't upload file: ${file.name}.`;

        xhr.addEventListener('error', () => reject(genericErrorText));
        xhr.addEventListener('abort', () => reject());
        xhr.addEventListener('load', () => {
            const response = xhr.response;

            if (!response || response.error) {
                return reject(response && response.error ? response.error.message : genericErrorText);
            }

            resolve(response);
        });

        if (xhr.upload) {
            xhr.upload.addEventListener('progress', evt => {
                if (evt.lengthComputable) {
                    loader.uploadTotal = evt.total;
                    loader.uploaded = evt.loaded;
                }
            });
        }
    }

    _sendRequest(file) {
        const data = new FormData();

        data.append('upload', file);

        this.xhr.send(data);
    }
}

function MyCustomUploadAdapterPlugin(editor) {
    editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
        return new MyUploadAdapter(loader);
    };
}


</script>