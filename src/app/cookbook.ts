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
    private cityid: number;
    private paymentmethod: number;
    private orderStatus: string;
    private giftStatus: boolean;
    private housenumber: number;

    constructor (cookbook: Cookbook){
        this.id = cookbook.id;
        this.designtitle = cookbook.designtitle;
        this.format = cookbook.format;
        this.orderNr = cookbook.orderNr;
        this.userId = cookbook.userId;
        this.dediction = cookbook.dediction;
        this.amount = cookbook.amount;
        this.orderDate = cookbook.orderDate;
        this.recipient = cookbook.recipient;
        this.street = cookbook.street;
        this.cityid = cookbook.cityid;
        this.paymentmethod = cookbook.paymentmethod;
        this.orderStatus = cookbook.orderStatus;
        this.giftStatus = cookbook.giftStatus;
        this.housenumber = cookbook.housenumber;
    }

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

    getCityId(): number{
        return this.cityid;
    }

    getPaymentMethod(): number{
        return this.paymentmethod;
    }

    getOrderStatus(): string{
        return this.orderStatus;
    }

    getGiftStatus(): boolean{
        return this.giftStatus;
    }

    getHouseNumber(): number{
        return this.housenumber;
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
    setAmount(amount: number){
        this.amount = amount;
    }
    setOrderDate(orderDate: Date){
        this.orderDate = orderDate;
    }

    setRecipient(recipient: string){
        this.recipient = recipient;
    }

    setStreet(street: string){
        this.street = street;
    }

    setCityId(cityid: number){
        this.cityid = cityid;
    }

    setPaymentMethod(paymentmethod: number){
        this.paymentmethod = paymentmethod;
    }

    setHousenumber(housenumber: number){
        this.housenumber = housenumber;
    }

    setOrderStatus(orderStatus: string){
        this.orderStatus = orderStatus;
    }

    setGiftStatus(giftStatus: boolean){
        this.giftStatus = giftStatus;
    }
}