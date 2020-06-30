import { CookbookFormat } from './cookbookFormat';

export class Cookbook{
    private id: number;
    private designtitle: string;
    private format: CookbookFormat;
    private orderNr: number;
    private userId: number;
    private dediction: string;
    private amount: number;
    private orderDate: Date;
    private recipient: string;
    private street: string;
    private orderStatus: string;
    private giftStatus: string;

    getId(): number{
        return this.id;
    }

    getDesigntitle(): string{
        return this.designtitle;
    }

    getFormat(): CookbookFormat{
        return this.format;
    }

    getOrderNr(): number{
        return this.orderNr;
    }

    getUserId(){
        return this.userId;
    }

    getDediction(): string{
        return this.dediction;
    }

    getAmount(): number{
        return this.amount;
    }

    getOrderDate(): Date{
        return this.orderDate;
    }

    getRecipient(): string{
        return this.recipient;
    }

    getStreet(): string{
        return this.street;
    }

    getOrderStatus(): string{
        return this.orderStatus;
    }

    getGiftStatus(): string{
        return this.giftStatus;
    }

    setDesigntitle(designtitle: string){
        this.designtitle = designtitle;
    }

    setFormat(format: CookbookFormat){
        this.format = format;
    }

    setUserId(userId: number){
        this.userId = userId;
    }

    setDediction(dediction: string){
        this.dediction = dediction;
    }
    /*setAmount(amount: number);
    setOrderDate(orderDate: Date);
    setRecipient(recipient: string);
    setStreet(street: string);
    setOrderStatus(orderStatus: string);
    setGiftStatus(giftStatus: string);*/
}