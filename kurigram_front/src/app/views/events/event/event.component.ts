import { Component, Input } from '@angular/core';
import { RequestService } from 'src/app/services/request.service';

@Component({
  selector: 'app-event',
  templateUrl: './event.component.html',
  styleUrls: ['./event.component.css']
})
export class EventComponent {

  @Input() imagen: string = "";
  @Input() titulo: string = "";
  @Input() description: string = "";
  @Input() horario: string = "";
  @Input() lugar: string = "";
  @Input() id: number = 0;

  constructor(public service : RequestService) { }

  apuntarEvento(id : number, event : MouseEvent)
  {
    if (localStorage.getItem('isUserLoggedIn') === "true") {
      let idEvent = id;
      let idUser = localStorage.getItem('id');

      this.service.assistEvents(idUser, idEvent).subscribe(response =>{
        this.apuntado(idEvent, event)
      });
    }
  }

  apuntado(idEvent : number, event : MouseEvent)
  {
    const button : HTMLButtonElement = <HTMLButtonElement>event.target;
    button.disabled = true;
    button.textContent = "APUNTADO"
 }
}