<template>
  <div>
    <!-- Button trigger modal -->
    <button
      type="button"
      class="btn btn-outline-primary"
      data-bs-toggle="modal"
      :data-bs-target="'#' + modalId"
    >
      Edit
    </button>

    <!-- Modal -->
    <div
      class="modal fade"
      ref="modal"
      :id="modalId"
      tabindex="-1"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel" style="color: black">
              Edit Article
            </h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form>
              <div class="mb-3">
                <input
                  type="text"
                  class="form-control"
                  id="exampleFormControlInput1"
                  v-model="editedArticle.name"
                  placeholder="Name"
                />
              </div>
              <div class="mb-3">
                <input
                  type="text"
                  v-model="editedArticle.price"
                  class="form-control"
                  id="exampleFormControlInput1"
                  placeholder="Price"
                />
              </div>
              <div class="mb-3">
                <input
                  type="text"
                  v-model="editedArticle.image_url"
                  class="form-control"
                  id="exampleFormControlInput1"
                  placeholder="Image URL"
                />
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
              Close
            </button>
            <button type="button" class="btn btn-primary" @click="updateArticle">
              Submit
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  props: {
    article: {
      type: Object,
      required: true,
    },
  },
  data() {
    return {
      modalId: `modal-${this.article.id}`,
      editedArticle: {
        name: this.article.name,
        price: this.article.price,
        image_url: this.article.image_url,
      },
    };
  },
  methods: {
    updateArticle() {
      axios
        .put(`http://127.0.0.1:8000/api/article/${this.article.id}`, this.editedArticle, {
            headers: {
            Authorization: "Bearer " + localStorage.getItem("token"),
    },
  })
        .then(() => {
          this.$emit("getArticles");
          this.$refs.modal.hide();
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },
};
</script>
