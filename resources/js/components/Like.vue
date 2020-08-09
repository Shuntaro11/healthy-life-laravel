<template>
    
        <div class="like-box" v-if="!liked">
            <button type="button" class="like-btn-wrapper" @click="like(postId)"><i class="far fa-heart like-button"></i></button>
            <p class="like-count">{{ likeCount }} 件</p>
        </div>

        <div class="like-box" v-else>
            <button type="button" class="like-btn-wrapper" @click="unlike(postId)"><i class="fas fa-heart like-button un-like-button"></i></button>
            <p class="like-count">{{ likeCount }} 件</p>
        </div>
    
</template>

<script>
    export default {
        props: ['postId', 'userId', 'defaultLiked', 'defaultCount'],
        data() {
            return {
                liked: false,
                likeCount: 0,
            };
        },
        created () {
            this.liked = this.defaultLiked
            this.likeCount = this.defaultCount
        },
        methods: {
            like(postId) {
                let url = `/api/posts/${postId}/like`
                axios.post(url, {
                    user_id: this.userId
                })
                .then(response => {
                  this.liked = true
                  this.likeCount = response.data.likeCount
                })
                .catch(error => {
                  alert(error)
                });
            },
            unlike(postId) {
                let url = `/api/posts/${postId}/unlike`
                axios.post(url, {
                    user_id: this.userId
                })
                .then(response => {
                  this.liked = false
                  this.likeCount = response.data.likeCount
                })
                .catch(error => {
                  alert(error)
                });
            }
        }
    }
</script>