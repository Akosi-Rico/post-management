<template>
    <div class="h-full w-full flex justify-center overflow-y-auto">
        <div class="grid grid-rows-1 w-1/2">
            <div class="card" v-for="item in resultset['personalPost']">
                <div class="card-header">
                    <img :src="avatarlogo" class=" h-14 w-14 rounded-full border-yellow-400 border overflow-hidden">
                    <small class="px-2 py-4"><span>Rico M. Hachero Jr</span></small>
                    <small class="py-4 font-normal"><span>1 hour ago</span></small>
                    <small class="py-4">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" class=" h-4 w-3">
                            <path strokeLinecap="round" strokeLinejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </small>
                </div>
                <div class="card-content">
                    <small class="flex justify-start p-3 ml-2">
                       {{ item.message }}
                    </small>
                </div>
                <div class="flex items-center justify-between px-4 py-1 mt-3 cursor-pointer">
                    <h3 class="text-lg font-semibold">View comments</h3>
                </div>
                <comment 
                    :items="item.comments"
                    :avatarlogo="avatarlogo"
                    :postcommenturl="postcommenturl"
                    :deletecommenturl="deletecommenturl">
                </comment>
                <reply
                    :items="item"
                    :avatarlogo="avatarlogo"
                    :postcommenturl="postcommenturl">
                </reply>
                <span
                    v-for="star in 5"
                    :key="star"
                    :class="{ 'text-yellow-400': star <= selectedStar }"
                    @mouseover="hoverStar(star)"
                    @click="selectStar(star, item.id)">
                    &#9733;
                </span>
            </div>
        </div>
    </div>
</template>
<script>
import AWN from "awesome-notifications";
import comment from "../account/comment.vue";
import reply from "../account/reply.vue";
export default {
    props: [
        "avatarlogo",
        "resultset",
        "postcommenturl",
        "deletecommenturl",
        "rateposturl",
    ],
    components: {
        AWN,
        comment,
        reply,
    },
    data() {
        return {
            selectedStar: 0,
            postId: null,
            rating: [],
        }
    },
    methods: {
        hoverStar(star) {
        // Update the selectedStar when hovering over the stars
         
           this.selectedStar = star;
        },
        selectStar(star, postId) {
            this.selectedStar = star;
            let temp = {
                "postId": postId,
                "rate": star
            }
            
            if (this.rating.length < 1) {
                this.rating.push(temp);
            }

            if (_.filter(this.rating, ['postId', postId])) {
                console.log("a");
            }

            // let _this = this;
            // let selected = this.rating.map(function(value) {
            //     if (value && value.postId == temp.postId) {
            //         value.rate = star;
            //     } else {
            //         _this.rating.push(temp);
            //     }
            // });
            // console.log(selected);
           
            
            // let _this = this;
            // axios({
            //     method: 'POST',
            //     url: _this.rateposturl,
            //     data: {
            //         postId: postId,
            //         rate: star
            //     }
            // }).then(response => {
            //     console.log(response);
            // })
            // .catch(error => {
            //     console.error('Logout failed:', error);
            // });
        },
    },
    
}
</script>
