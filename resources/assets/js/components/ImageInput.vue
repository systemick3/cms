<template>
  <div>
    <label for="image">Banner image:</label>
    <div v-if="showImage()">
      <img width="200" height="100" :src="showImageUrl()" />
      <div><a v-on:click="toggle()" class="change-image" href="#">Remove image.</a></div>
      <input type="hidden" name="file_id" :value="showFileId()" />
    </div>
    <div v-else>
      <input type="file" name="image" id="image" />
    </div>
  </div>
</template>

<script>
  export default {
    props: ['initialImage', 'fileId', 'imageUrl'],
    data(){
      return {
        show: this.initialImage,
        fid: this.fileId,
        url: this.imageUrl
      }
    },
    methods: {
      showImage: function() {
        return this.show;
      },
      toggle: function() {
        this.show = !this.show;
      },
      showFileId: function() {
        return this.fid;
      },
      showImageUrl: function() {
        return this.url;
      }
    }
  }
</script>
