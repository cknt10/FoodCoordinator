export class Ratings{
    private userId: number;
    private comment: string;
    private rating: number;
    
    constructor(rating: Ratings){
        this.userId = rating.userId;
        this.comment = rating.comment;
        this.rating  = rating.rating;
    }

    getUserId(){
        return this.userId;
    }

    getComment(){
        return this.comment;
    }

    getRating(){
        return this.rating;
    }

    setUserId(id: number){
        this.userId = id;
    }

    setComment(comment: string){
        this.comment = comment;
    }

    setRating(rating: number){
        this.rating = rating;
    }
}