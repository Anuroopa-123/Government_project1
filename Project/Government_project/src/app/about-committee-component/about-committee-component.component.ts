import { CommonModule } from '@angular/common';
import { Component } from '@angular/core';
import { FormsModule } from '@angular/forms';

@Component({
  selector: 'app-about-committee-component',
  standalone: true,
  imports: [CommonModule, FormsModule],
  templateUrl: './about-committee-component.component.html',
  styleUrl: './about-committee-component.component.css',
})
export class AboutCommitteeComponentComponent {
  committeeItems = [
    {
      title: 'Assembly Announcement',
      description:
        'Includes video and text content about the formation of the current Union-State Relations Committee.',
    },
    {
      title: 'Press Releases',
      description:
        "Official press releases available in English and Tamil about the committee's formation.",
    },
    {
      title: 'Committee Members',
      description:
        'Photographs and brief bios of the Chairman and two other committee members.',
    },
    {
      title: 'Historic Committees',
      points: [
        'Rajamannar Committee - ToR, Questionnaire, Report Link',
        'Sarkaria Committee - ToR, Questionnaire, Report Link',
        'Punchi Committee - ToR, Questionnaire, Report Link',
      ],
    },
    {
      title: 'Ex-Chief Ministers’ Announcements',
      description:
        'Statements and decisions made by Thiru. C.N. Annadurai and Thiru. M. Karunanidhi.',
    },
    {
      title: 'Historic & Legal Links',
      points: [
        'Links to Historic Announcements',
        'Constitution of India (India Code Website)',
        'Constituent Assembly Debates',
      ],
    },
    {
      title: 'Famous Quotes on Federalism',
      points: [
        'By Thiru. C.N. Annadurai',
        'By Thiru. M. Karunanidhi',
        'Constituent Assembly (e.g., K. Santhanam)',
      ],
    },
  ];
}
