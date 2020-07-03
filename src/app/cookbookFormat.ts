export class CookbookFormat{
private id: number;
private title: string;
private format: string;
private pages: number;
private price: number;

constructor(cookbookFormat: CookbookFormat){
this.id = cookbookFormat.id;
this.title = cookbookFormat.title;
this.format = cookbookFormat.format;
this.pages = cookbookFormat.pages;
this.price = cookbookFormat.price;
}

getId(): number{
    return this.id;
}

getTitle(): string{
    return this.title;
}

getFormat(): string{
    return this.format;
}

getPages(): number{
    return this.pages;
}

getPrice(): number{
    return this.price;
}

setTitle(title: string){
    this.title = title;
}

setFormat(format: string){
    this.format = format;
}

setPages(pages: number){
    this.pages = pages;
}

setPrice(price: number){
    this.price = price;
}
}