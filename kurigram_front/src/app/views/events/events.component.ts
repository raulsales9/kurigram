import { Component } from '@angular/core';
import { Contents, contents } from './events.interface';
import { RequestService } from 'src/app/services/request.service';

@Component({
  selector: 'app-events',
  templateUrl: './events.component.html',
  styleUrls: ['./events.component.css']
})
export class EventsComponent {
 /*  public number: number = 1;
  public contents: Contents[] = contents;
  constructor (public service : RequestService) { }

  ngOnInit()
  {
    
    this.service.getEvents().subscribe(response =>{
      if (response) {
        for (let i = 0; i < this.contents.length; i++) {
          let start_date = response[i]?.start_date?.date ? this.changeFormat(response[i].start_date.date) : "";
          let end_date = response[i]?.end_date?.date ? this.changeFormat(response[i].end_date.date) : "";
          this.contents[i] = {
            imagen: response[i]?.imagen ? "http://localhost:8000/assets/img/" + response[i].imagen : "",
            titulo: response[i].name,
            description: response[i].description,
            horario: start_date[0] + " - " + end_date[0],
            lugar: response[i].place,
            id: response[i].id
          };
        }
      }
    });
  }

  changeFormat(date : any)
  {
    return date.split(" ");
  } */
}
