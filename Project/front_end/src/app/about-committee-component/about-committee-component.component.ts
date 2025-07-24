import { CommonModule } from '@angular/common';
import { Component } from '@angular/core';
import { FormsModule } from '@angular/forms';


interface CommitteeItem {
  title: string;
  key: string;
  description?: string;
  points?: string[];
}
@Component({
  selector: 'app-about-committee-component',
  standalone: true,
  imports: [CommonModule, FormsModule],
  templateUrl: './about-committee-component.component.html',
  styleUrl: './about-committee-component.component.css',
})
export class AboutCommitteeComponentComponent {
  committeeItems: CommitteeItem[] = [
    {
      title: 'Assembly Announcement',
      key: 'assembly-announcement',
      description:
        'Includes video and text content about the formation of the current Union-State Relations Committee.',
    },
    {
      title: 'Press Releases',
      key: 'press-releases',
      description:
        "Official press releases available in English and Tamil about the committee's formation.",
    },
    {
      title: 'Committee Members',
      key: 'committee-members',
      description:
        'Photographs and brief bios of the Chairman and two other committee members.',
    },
    {
      title: 'Historic Committees',
      key: 'historic-committees',
      points: [
        'Rajamannar Committee - ToR, Questionnaire, Report Link',
        'Sarkaria Committee - ToR, Questionnaire, Report Link',
        'Punchi Committee - ToR, Questionnaire, Report Link',
      ],
    },
    {
      title: 'Ex-Chief Ministers’ Announcements',
      key: 'ex-chief-ministers-announcements',
      description:
        'Statements and decisions made by Thiru. C.N. Annadurai and Thiru. M. Karunanidhi.',
    },
    {
      title: 'Historic & Legal Links',
      key: 'historic-legal-links',
      points: [
        'Links to Historic Announcements',
        'Constitution of India (India Code Website)',
        'Constituent Assembly Debates',
      ],
    },
  ];

  selectedKey: string = 'assembly-announcement';
  selectedItem: CommitteeItem = this.committeeItems[0]; // Default to the first item

  selectItem(key: string): void {
    this.selectedKey = key;
    this.selectedItem = this.committeeItems.find((item) => item.key === key)!;
  }

  isItemData(item: CommitteeItem): boolean {
    return !!item.description;
  }

  isItemWithPoints(item: CommitteeItem): boolean {
    return !!item.points;
  }
}
