import  { PremiumModel } from './premiumModel';
import { Gift } from './gift';
import { Recipe } from './recipe';
import { User } from './user';

export  class Premium {
    private id: number;
    private premiumModel: PremiumModel;
    private gift: Gift[];
    private startDate: Date;
    private favorites: Recipe[];

    constructor(premium: Premium){
        this.id = premium.id;
        this.premiumModel = premium.premiumModel;
        this.gift = premium.gift;
        this.startDate = premium.startDate;
        this.favorites = premium.favorites;
    }

    endPremium(): Date{
        let endDate: Date=new Date(this.startDate.getTime()+this.getPremiumModel().getDuration());

        let end: Date;
        end.setDate(this.startDate.getDate() + this.premiumModel.getDuration());

        return endDate;
    }

    getId(){
      return this.id;
    }

    getPremiumModel(){
      return this.premiumModel;
    }

    getGift(){
      return this.gift
    }

    getStartDate(){
      return this.startDate;
    }

    getFavorites(){
      return this.favorites;
    }
}
