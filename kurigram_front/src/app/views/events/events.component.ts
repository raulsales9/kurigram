import { Component, OnInit } from '@angular/core';
import { RequestService } from 'src/app/services/request.service';
import { Events } from 'src/app/models/events';

@Component({
  selector: 'app-events',
  templateUrl: './events.component.html',
  styleUrls: ['./events.component.css']
})
export class EventsComponent implements OnInit {

  events: Events[];

  constructor(private requestService: RequestService) { }

  ngOnInit() {
    this.getEvents();
  }

  getEvents(): void {
    this.requestService.getEvents()
      .subscribe(events => this.events = events);
  }

}
