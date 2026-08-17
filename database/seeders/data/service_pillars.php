<?php

/**
 * Données initiales des 5 piliers stratégiques et de leurs modules.
 * Source : document client « Nos services 07 08 2026 ».
 *
 * @return array<int, array<string, mixed>>
 */
return [
    [
        'slug' => 'gouvernance-performance-operationnelle',
        'sort_order' => 1,
        'icon' => 'heroicon-o-chart-bar',
        'featured_image' => 'services/service-1.png',
        'title' => [
            'fr' => 'Gouvernance & Performance Opérationnelle',
            'en' => 'Governance & Operational Performance',
        ],
        'tagline' => [
            'fr' => 'Nous transformons vos processus en leviers de transparence et d\'efficacité.',
            'en' => 'We turn your processes into drivers of transparency and efficiency.',
        ],
        'client_challenge' => [
            'fr' => 'Traçabilité, transparence, efficacité',
            'en' => 'Traceability, transparency, efficiency',
        ],
        'offer_summary' => [
            'fr' => 'ERP, workflow, dématérialisation, suivi-évaluation',
            'en' => 'ERP, workflow, digitization, monitoring and evaluation',
        ],
        'differentiator' => [
            'fr' => 'Là où d\'autres proposent des logiciels, SkyITup vous offre une gouvernance digitale. Notre approche ERP ne se limite pas à la comptabilité : elle intègre l\'ensemble de vos processus métiers pour une transparence totale, gage de confiance pour vos partenaires et bailleurs de fonds.',
            'en' => 'Where others sell software, SkyITup delivers digital governance. Our ERP approach goes beyond accounting: it integrates your entire business processes for full transparency—a guarantee of trust for partners and funders.',
        ],
        'meta_description' => [
            'fr' => 'Pilier Gouvernance & Performance Opérationnelle : ERP, RH, dématérialisation, suivi-évaluation et migration de données pour la transparence et l\'efficacité en RDC.',
            'en' => 'Governance & Operational Performance pillar: ERP, HR, digitization, monitoring and data migration for transparency and efficiency in the DRC.',
        ],
        'modules' => [
            [
                'slug' => 'erp-integre',
                'sort_order' => 1,
                'icon' => 'heroicon-o-squares-2x2',
                'cta_delay' => '48h',
                'featured_image' => null,
                'title' => [
                    'fr' => 'ERP intégré (Odoo, SYSCOHADA, SYSCEBNL)',
                    'en' => 'Integrated ERP (Odoo, SYSCOHADA, SYSCEBNL)',
                ],
                'benefit_text' => [
                    'fr' => '<p>Centralisez en temps réel l\'intégralité de vos opérations – achats, ventes, stocks, production et finances – dans un tableau de bord unique, sans ressaisie ni silos.</p><p>Déjà plébiscitée par 250 entreprises industrielles, notre plateforme réduit de 25&nbsp;% les ruptures de stock et améliore de 40&nbsp;% la visibilité sur votre trésorerie.</p>',
                    'en' => '<p>Centralize all your operations in real time—purchasing, sales, inventory, production and finance—in a single dashboard, with no re-entry and no silos.</p><p>Already trusted by 250 industrial companies, our platform cuts stock-outs by 25% and improves cash visibility by 40%.</p>',
                ],
                'summary_text' => [
                    'fr' => 'Solution compatible OHADA RDC ; adaptée aux établissements publics pour assurer une traçabilité totale des fonds.',
                    'en' => 'OHADA DRC–compliant solution; suited to public institutions for full traceability of funds.',
                ],
                'cta_label' => [
                    'fr' => 'Profitez-en : recevez votre audit de performance opérationnelle personnalisé sous 48h, sans engagement.',
                    'en' => 'Take advantage: receive your personalized operational performance audit within 48 hours, with no commitment.',
                ],
                'meta_description' => [
                    'fr' => 'ERP intégré Odoo compatible SYSCOHADA et SYSCEBNL : tableau de bord unifié, traçabilité des fonds publics en RDC.',
                    'en' => 'Integrated Odoo ERP compatible with SYSCOHADA and SYSCEBNL: unified dashboard and public funds traceability in the DRC.',
                ],
            ],
            [
                'slug' => 'rh-paie',
                'sort_order' => 2,
                'icon' => 'heroicon-o-user-group',
                'cta_delay' => '48h',
                'featured_image' => null,
                'title' => [
                    'fr' => 'Ressources Humaines & Calcul de la paie',
                    'en' => 'Human Resources & Payroll',
                ],
                'benefit_text' => [
                    'fr' => '<p>Automatisez l\'intégralité de votre cycle RH – planning, absences, contrats, notes de frais et paie – dans un seul référentiel sécurisé, sans ressaisie ni risques d\'erreur de calcul.</p><p>Déjà plébiscitée par 300 responsables RH, notre solution réduit de 75&nbsp;% le temps de préparation des bulletins et élimine 100&nbsp;% des anomalies liées aux changements réglementaires (conventions collectives, plafonds SS, prélèvement à la source).</p>',
                    'en' => '<p>Automate your entire HR cycle—scheduling, absences, contracts, expense reports and payroll—in one secure repository, with no re-entry and no calculation errors.</p><p>Already trusted by 300 HR managers, our solution cuts payroll preparation time by 75% and eliminates 100% of anomalies linked to regulatory changes (collective agreements, social security caps, withholding tax).</p>',
                ],
                'summary_text' => [
                    'fr' => 'Solution compatible Code du travail RDC ; adaptée aux établissements publics pour assurer une traçabilité totale des fonds. Odoo RH/Employé & StarPaie.',
                    'en' => 'DRC Labour Code–compliant solution; suited to public institutions for full funds traceability. Odoo HR/Employee & StarPaie.',
                ],
                'cta_label' => [
                    'fr' => 'Profitez-en : obtenez un audit flash de votre conformité sociale sous 48h, sans engagement.',
                    'en' => 'Take advantage: get a quick audit of your social compliance within 48 hours, with no commitment.',
                ],
                'meta_description' => [
                    'fr' => 'RH et paie automatisées avec Odoo RH/Employé et StarPaie, conformes au Code du travail RDC.',
                    'en' => 'Automated HR and payroll with Odoo HR/Employee and StarPaie, compliant with the DRC Labour Code.',
                ],
            ],
            [
                'slug' => 'dematerialisation-ecm',
                'sort_order' => 3,
                'icon' => 'heroicon-o-document-text',
                'cta_delay' => '72h',
                'featured_image' => null,
                'title' => [
                    'fr' => 'Dématérialisation des processus (ECM)',
                    'en' => 'Process Digitization (ECM)',
                ],
                'benefit_text' => [
                    'fr' => '<p>Supprimez les goulots d\'étranglement en automatisant la circulation de vos courriers, dossiers et workflows de validation – sans perte de documents ni saisies manuelles.</p><p>Déjà déployée chez 50 directions administratives, notre solution GED réduit de 50&nbsp;% vos délais de traitement et élimine 30&nbsp;% des erreurs de transmission.</p>',
                    'en' => '<p>Remove bottlenecks by automating the flow of mail, files and approval workflows—with no lost documents and no manual data entry.</p><p>Already deployed in 50 administrative departments, our ECM solution cuts processing times by 50% and eliminates 30% of transmission errors.</p>',
                ],
                'summary_text' => [
                    'fr' => 'ECM : gestion électronique des courriers, traitement des dossiers et leurs workflows & archivage.',
                    'en' => 'ECM: electronic mail management, case processing, workflows and archiving.',
                ],
                'cta_label' => [
                    'fr' => 'Profitez-en : recevez votre diagnostic flash de maturité numérique sous 72h, sans engagement.',
                    'en' => 'Take advantage: receive your quick digital maturity assessment within 72 hours, with no commitment.',
                ],
                'meta_description' => [
                    'fr' => 'Dématérialisation ECM : GED, workflows et archivage pour accélérer le traitement administratif.',
                    'en' => 'ECM digitization: document management, workflows and archiving to speed up administrative processing.',
                ],
            ],
            [
                'slug' => 'gestion-projet-suivi-evaluation',
                'sort_order' => 4,
                'icon' => 'heroicon-o-clipboard-document-check',
                'cta_delay' => '24h',
                'featured_image' => null,
                'title' => [
                    'fr' => 'Gestion de projet & Suivi-Évaluation',
                    'en' => 'Project Management & Monitoring-Evaluation',
                ],
                'benefit_text' => [
                    'fr' => '<p>Anticipez les dérives budgétaires et sécurisez vos marges en pilotant chaque projet sous tous ses angles – avancement physique, coûts engagés, délais restants et indicateurs stratégiques – dans un tableau de bord unifié, actualisé en continu et entièrement personnalisable.</p><p>Déjà plébiscitée par 120 directeurs de projet, notre solution réduit de 35&nbsp;% les écarts entre le prévisionnel et le réalisé, et double leur réactivité face aux aléas.</p>',
                    'en' => '<p>Anticipate budget overruns and protect margins by managing every project across physical progress, committed costs, remaining deadlines and strategic indicators—in a unified, continuously updated and fully customizable dashboard.</p><p>Already trusted by 120 project directors, our solution reduces forecast vs. actual gaps by 35% and doubles responsiveness to unforeseen events.</p>',
                ],
                'summary_text' => [
                    'fr' => 'Plateforme pour suivre l\'avancement des chantiers en temps réel.',
                    'en' => 'Platform to track project progress in real time.',
                ],
                'cta_label' => [
                    'fr' => 'Profitez-en : recevez votre diagnostic express de pilotage projet sous 24h, sans engagement.',
                    'en' => 'Take advantage: receive your express project management assessment within 24 hours, with no commitment.',
                ],
                'meta_description' => [
                    'fr' => 'Gestion de projet et suivi-évaluation : tableaux de bord unifiés pour piloter chantiers et budgets.',
                    'en' => 'Project management and monitoring-evaluation: unified dashboards to steer projects and budgets.',
                ],
            ],
            [
                'slug' => 'migration-donnees',
                'sort_order' => 5,
                'icon' => 'heroicon-o-arrow-path',
                'cta_delay' => '48h',
                'featured_image' => null,
                'title' => [
                    'fr' => 'Migration et paramétrage de données',
                    'en' => 'Data Migration & Configuration',
                ],
                'benefit_text' => [
                    'fr' => '<p>Sécurisez la continuité de votre activité en migrant vos données critiques – comptes, immobilisations, tiers et stocks – sans perte ni altération, même lors des transitions système les plus complexes.</p><p>Déjà adoptée par 80 directions informatiques, notre méthodologie garantit l\'intégrité de 100&nbsp;% de vos données historiques et réduit de 60&nbsp;% vos délais de recette post-migration.</p>',
                    'en' => '<p>Secure business continuity by migrating your critical data—accounts, fixed assets, third parties and inventory—with no loss or corruption, even during the most complex system transitions.</p><p>Already adopted by 80 IT departments, our methodology guarantees 100% integrity of historical data and cuts post-migration acceptance timelines by 60%.</p>',
                ],
                'summary_text' => [
                    'fr' => 'Migration des balances, codification, formatage et mise à jour des données de base.',
                    'en' => 'Migration of trial balances, coding, formatting and updating of master data.',
                ],
                'cta_label' => [
                    'fr' => 'Profitez-en : recevez votre diagnostic de vulnérabilité des données sous 48h, sans engagement.',
                    'en' => 'Take advantage: receive your data vulnerability assessment within 48 hours, with no commitment.',
                ],
                'meta_description' => [
                    'fr' => 'Migration et paramétrage de données : intégrité garantie lors des transitions ERP et systèmes métiers.',
                    'en' => 'Data migration and configuration: guaranteed integrity during ERP and business system transitions.',
                ],
            ],
        ],
    ],
    [
        'slug' => 'decision-innovation',
        'sort_order' => 2,
        'icon' => 'heroicon-o-light-bulb',
        'featured_image' => 'services/service-2.jpg',
        'title' => [
            'fr' => 'Décision & Innovation',
            'en' => 'Decision & Innovation',
        ],
        'tagline' => [
            'fr' => 'Nous utilisons la donnée pour vous aider à anticiper, plutôt que subir.',
            'en' => 'We use data to help you anticipate rather than react.',
        ],
        'client_challenge' => [
            'fr' => 'Anticipation, optimisation des ressources',
            'en' => 'Anticipation, resource optimization',
        ],
        'offer_summary' => [
            'fr' => 'IA, analyse prédictive, data',
            'en' => 'AI, predictive analytics, data',
        ],
        'differentiator' => [
            'fr' => 'SkyITup est l\'un des rares acteurs en Afrique à intégrer l\'IA dans ses solutions de gouvernance. Nous vous permettons de passer d\'une logique réactive à une logique prédictive, maximisant ainsi l\'impact social de chaque dollar investi.',
            'en' => 'SkyITup is one of the few players in Africa integrating AI into governance solutions. We help you move from reactive to predictive logic, maximizing the social impact of every dollar invested.',
        ],
        'meta_description' => [
            'fr' => 'Pilier Décision & Innovation : IA, analyse prédictive et optimisation budgétaire pour anticiper les besoins et maximiser l\'impact social.',
            'en' => 'Decision & Innovation pillar: AI, predictive analytics and budget optimization to anticipate needs and maximize social impact.',
        ],
        'modules' => [
            [
                'slug' => 'analyse-predictive',
                'sort_order' => 1,
                'icon' => 'heroicon-o-chart-pie',
                'cta_delay' => '72h',
                'featured_image' => null,
                'title' => [
                    'fr' => 'Analyse prédictive des besoins',
                    'en' => 'Predictive Needs Analysis',
                ],
                'benefit_text' => [
                    'fr' => '<p>Ciblez avec certitude les zones d\'investissement à plus fort impact social en croisant automatiquement vos données démographiques, économiques et historiques grâce à notre IA prédictive.</p><p>Déjà expérimentée par 15 collectivités, notre approche augmente de 40&nbsp;% l\'efficacité des fonds alloués et réduit de 50&nbsp;% les études de terrain préalables.</p>',
                    'en' => '<p>Target high-impact investment areas with certainty by automatically cross-referencing demographic, economic and historical data through our predictive AI.</p><p>Already tested by 15 local authorities, our approach increases allocated funds efficiency by 40% and cuts preliminary field studies by 50%.</p>',
                ],
                'summary_text' => [
                    'fr' => 'Utiliser l\'IA pour analyser les données afin d\'identifier les quartiers prioritaires.',
                    'en' => 'Use AI to analyze data and identify priority neighborhoods.',
                ],
                'cta_label' => [
                    'fr' => 'Profitez-en : simulez gratuitement une cartographie priorisée de vos quartiers sous 72h, sans engagement.',
                    'en' => 'Take advantage: simulate a free prioritized mapping of your neighborhoods within 72 hours, with no commitment.',
                ],
                'meta_description' => [
                    'fr' => 'Analyse prédictive par IA pour identifier les zones d\'investissement prioritaires à fort impact social.',
                    'en' => 'Predictive AI analysis to identify priority high social-impact investment areas.',
                ],
            ],
            [
                'slug' => 'optimisation-budgetaire',
                'sort_order' => 2,
                'icon' => 'heroicon-o-calculator',
                'cta_delay' => '48h',
                'featured_image' => null,
                'title' => [
                    'fr' => 'Algorithmes d\'optimisation budgétaire',
                    'en' => 'Budget Optimization Algorithms',
                ],
                'benefit_text' => [
                    'fr' => '<p>Répartissez vos budgets provinciaux de manière équitable et transparente en laissant nos algorithmes pondérer automatiquement l\'urgence sociale, le taux de pauvreté et le nombre de bénéficiaires – sans biais ni arbitrage manuel.</p><p>Déjà validée par 3 ministères, notre solution réduit de 30&nbsp;% les délais d\'arbitrage et maximise de 25&nbsp;% l\'impact social par euro engagé.</p>',
                    'en' => '<p>Allocate provincial budgets fairly and transparently by letting our algorithms automatically weight social urgency, poverty rates and number of beneficiaries—with no bias or manual arbitration.</p><p>Already validated by 3 ministries, our solution cuts arbitration delays by 30% and maximizes social impact per euro spent by 25%.</p>',
                ],
                'summary_text' => [
                    'fr' => 'Algorithmes pour optimiser l\'allocation des budgets en fonction de l\'urgence et de l\'impact social.',
                    'en' => 'Algorithms to optimize budget allocation based on urgency and social impact.',
                ],
                'cta_label' => [
                    'fr' => 'Profitez-en : testez un scénario d\'allocation personnalisé pour votre structure sous 48h, sans engagement.',
                    'en' => 'Take advantage: test a personalized allocation scenario for your organization within 48 hours, with no commitment.',
                ],
                'meta_description' => [
                    'fr' => 'Optimisation budgétaire par algorithmes : allocation équitable des budgets provinciaux selon l\'impact social.',
                    'en' => 'Algorithmic budget optimization: fair allocation of provincial budgets based on social impact.',
                ],
            ],
            [
                'slug' => 'traitement-intelligent-demandes',
                'sort_order' => 3,
                'icon' => 'heroicon-o-chat-bubble-left-right',
                'cta_delay' => '24h',
                'featured_image' => null,
                'title' => [
                    'fr' => 'Traitement intelligent des demandes',
                    'en' => 'Intelligent Request Processing',
                ],
                'benefit_text' => [
                    'fr' => '<p>Désengorgez vos services en traitant automatiquement 80&nbsp;% des demandes courantes – de la classification sémantique à la réponse prérédigée – grâce à nos chatbots et moteurs de routage intelligent.</p><p>Déjà opérationnelle dans 40 guichets, notre solution réduit le temps de réponse usager de 65&nbsp;% et libère 30&nbsp;% de vos agents pour les dossiers complexes à valeur ajoutée.</p>',
                    'en' => '<p>Relieve pressure on your services by automatically handling 80% of routine requests—from semantic classification to pre-drafted replies—using our chatbots and intelligent routing engines.</p><p>Already operational in 40 service counters, our solution cuts citizen response time by 65% and frees 30% of your staff for high-value complex cases.</p>',
                ],
                'summary_text' => [
                    'fr' => 'Chatbots ou systèmes de classification automatique des requêtes.',
                    'en' => 'Chatbots or automatic request classification systems.',
                ],
                'cta_label' => [
                    'fr' => 'Profitez-en : faites analyser gratuitement un échantillon de vos requêtes historiques sous 24h, sans engagement.',
                    'en' => 'Take advantage: have a sample of your historical requests analyzed free of charge within 24 hours, with no commitment.',
                ],
                'meta_description' => [
                    'fr' => 'Traitement intelligent des demandes : chatbots et classification automatique pour désengorger vos services.',
                    'en' => 'Intelligent request processing: chatbots and automatic classification to relieve your service desks.',
                ],
            ],
        ],
    ],
    [
        'slug' => 'securite-confiance',
        'sort_order' => 3,
        'icon' => 'heroicon-o-shield-check',
        'featured_image' => 'services/service-3.jpg',
        'title' => [
            'fr' => 'Sécurité & Confiance',
            'en' => 'Security & Trust',
        ],
        'tagline' => [
            'fr' => 'La confiance est notre premier logiciel. Nous sécurisons vos données comme nos propres actifs.',
            'en' => 'Trust is our first software. We secure your data as we would our own assets.',
        ],
        'client_challenge' => [
            'fr' => 'Protection des données, conformité',
            'en' => 'Data protection, compliance',
        ],
        'offer_summary' => [
            'fr' => 'Cybersécurité, audit, RGPD, infrastructure sécurisée',
            'en' => 'Cybersecurity, audit, GDPR, secure infrastructure',
        ],
        'differentiator' => [
            'fr' => 'En tant qu\'institution financière ou entreprise, vous êtes une cible. SkyITup ne se contente pas d\'installer un antivirus : nous construisons une forteresse numérique autour de vos données, avec des protocoles de sécurité éprouvés au niveau international.',
            'en' => 'As a financial institution or business, you are a target. SkyITup does not simply install antivirus software: we build a digital fortress around your data with internationally proven security protocols.',
        ],
        'meta_description' => [
            'fr' => 'Pilier Sécurité & Confiance : audit, conformité RGPD/RDC, sécurisation des infrastructures et sensibilisation cybersécurité.',
            'en' => 'Security & Trust pillar: audit, GDPR/DRC compliance, infrastructure hardening and cybersecurity awareness.',
        ],
        'modules' => [
            [
                'slug' => 'audit-securite-conformite',
                'sort_order' => 1,
                'icon' => 'heroicon-o-magnifying-glass-circle',
                'cta_delay' => '48h',
                'featured_image' => null,
                'title' => [
                    'fr' => 'Audit de sécurité et conformité',
                    'en' => 'Security & Compliance Audit',
                ],
                'benefit_text' => [
                    'fr' => '<p>Anticipez les audits externes et les sanctions en réalisant un diagnostic complet de votre SI – vulnérabilités techniques, conformité RGPD/RDC et pratiques internes – pour colmater chaque faille avant qu\'elle ne soit exploitée.</p><p>Déjà déployé auprès de 25 DSI, notre audit identifie en moyenne 15 failles critiques sous 5 jours et réduit de 90&nbsp;% les risques de non-conformité réglementaire.</p>',
                    'en' => '<p>Anticipate external audits and penalties with a full assessment of your IT environment—technical vulnerabilities, GDPR/DRC compliance and internal practices—to close every gap before it is exploited.</p><p>Already deployed for 25 IT directors, our audit identifies an average of 15 critical flaws within 5 days and reduces regulatory non-compliance risk by 90%.</p>',
                ],
                'summary_text' => [
                    'fr' => 'Audit de sécurité et RGPD/RDC.',
                    'en' => 'Security audit and GDPR/DRC compliance.',
                ],
                'cta_label' => [
                    'fr' => 'Profitez-en : recevez votre pré-diagnostic de conformité express sous 48h, sans engagement.',
                    'en' => 'Take advantage: receive your express compliance pre-assessment within 48 hours, with no commitment.',
                ],
                'meta_description' => [
                    'fr' => 'Audit de sécurité et conformité RGPD/RDC : diagnostic complet des vulnérabilités de votre SI.',
                    'en' => 'Security and GDPR/DRC compliance audit: comprehensive assessment of your IT vulnerabilities.',
                ],
            ],
            [
                'slug' => 'securisation-infrastructures',
                'sort_order' => 2,
                'icon' => 'heroicon-o-lock-closed',
                'cta_delay' => '72h',
                'featured_image' => null,
                'title' => [
                    'fr' => 'Sécurisation des infrastructures (Firewall, VPN, contrôle d\'accès)',
                    'en' => 'Infrastructure Hardening (Firewall, VPN, Access Control)',
                ],
                'benefit_text' => [
                    'fr' => '<p>Verrouillez chaque point d\'entrée de votre réseau en déployant une défense multicouche – Firewall nouvelle génération, VPN chiffré et contrôle d\'accès granulaire (intranet et physique) – pour neutraliser toute tentative d\'intrusion avant qu\'elle n\'atteigne vos données sensibles.</p><p>Déjà opérationnelle chez 60 structures publiques, notre architecture bloque 99,8&nbsp;% des attaques connues et réduit de 70&nbsp;% le temps de détection des intrusions résiduelles.</p>',
                    'en' => '<p>Lock down every entry point on your network with multi-layer defense—next-generation firewall, encrypted VPN and granular access control (intranet and physical)—to neutralize intrusion attempts before they reach sensitive data.</p><p>Already operational in 60 public organizations, our architecture blocks 99.8% of known attacks and cuts residual intrusion detection time by 70%.</p>',
                ],
                'summary_text' => [
                    'fr' => 'Sécurité (Firewall, sécurité d\'accès intranet, sécurité physique).',
                    'en' => 'Security (firewall, intranet access security, physical security).',
                ],
                'cta_label' => [
                    'fr' => 'Profitez-en : auditons gratuitement la vulnérabilité de votre réseau sous 72h, sans engagement.',
                    'en' => 'Take advantage: we will audit your network vulnerability free of charge within 72 hours, with no commitment.',
                ],
                'meta_description' => [
                    'fr' => 'Sécurisation des infrastructures : firewall, VPN et contrôle d\'accès pour protéger votre réseau.',
                    'en' => 'Infrastructure hardening: firewall, VPN and access control to protect your network.',
                ],
            ],
            [
                'slug' => 'securisation-paiements',
                'sort_order' => 3,
                'icon' => 'heroicon-o-credit-card',
                'cta_delay' => '48h',
                'featured_image' => null,
                'title' => [
                    'fr' => 'Sécurisation des transactions et paiements',
                    'en' => 'Transaction & Payment Security',
                ],
                'benefit_text' => [
                    'fr' => '<p>Garantissez l\'intégrité absolue et la confidentialité de chaque flux financier – paiements, virements, subventions – grâce à un chiffrement de bout en bout, une tokenisation des données sensibles et une traçabilité renforcée, répondant aux exigences les plus strictes des institutions publiques.</p><p>Déjà utilisée par 15 directions financières, notre solution certifie 100&nbsp;% des transactions réalisées et réduit de 95&nbsp;% les tentatives de fraude détectées en temps réel.</p>',
                    'en' => '<p>Guarantee absolute integrity and confidentiality of every financial flow—payments, transfers, grants—with end-to-end encryption, sensitive data tokenization and enhanced traceability, meeting the strictest public institution requirements.</p><p>Already used by 15 finance departments, our solution certifies 100% of transactions and reduces real-time detected fraud attempts by 95%.</p>',
                ],
                'summary_text' => [
                    'fr' => 'Sécurisation des paiements.',
                    'en' => 'Payment security.',
                ],
                'cta_label' => [
                    'fr' => 'Profitez-en : simulez un scénario de sécurisation financière pour votre entité sous 48h, sans engagement.',
                    'en' => 'Take advantage: simulate a financial security scenario for your organization within 48 hours, with no commitment.',
                ],
                'meta_description' => [
                    'fr' => 'Sécurisation des transactions et paiements : chiffrement, tokenisation et anti-fraude en temps réel.',
                    'en' => 'Transaction and payment security: encryption, tokenization and real-time fraud prevention.',
                ],
            ],
            [
                'slug' => 'sensibilisation-cybersecurite-infra',
                'sort_order' => 4,
                'icon' => 'heroicon-o-exclamation-triangle',
                'cta_delay' => '24h',
                'featured_image' => null,
                'title' => [
                    'fr' => 'Sensibilisation à la cybersécurité',
                    'en' => 'Cybersecurity Awareness',
                ],
                'benefit_text' => [
                    'fr' => '<p>Transformez vos collaborateurs en véritable première ligne de défense en identifiant et corrigeant leurs comportements à risque – phishing, arnaques, ingénierie sociale – grâce à des simulations immersives et des modules de formation adaptés à vos métiers et à votre culture d\'entreprise.</p><p>Déjà déployée dans 200 organisations, notre approche réduit de 60&nbsp;% les clics sur des liens malveillants et divise par 3 le nombre d\'incidents liés à l\'erreur humaine en moins de 6 mois.</p>',
                    'en' => '<p>Turn your staff into a true first line of defense by identifying and correcting risky behaviors—phishing, scams, social engineering—through immersive simulations and training modules tailored to your roles and culture.</p><p>Already deployed in 200 organizations, our approach cuts clicks on malicious links by 60% and divides human-error incidents by 3 in under 6 months.</p>',
                ],
                'summary_text' => [
                    'fr' => 'Sensibilisation à la sécurité informatique, cybercriminalité.',
                    'en' => 'IT security awareness and cybercrime prevention.',
                ],
                'cta_label' => [
                    'fr' => 'Profitez-en : faites tester gratuitement vos équipes avec une campagne de phishing simulée sous 24h, sans engagement.',
                    'en' => 'Take advantage: have your teams tested free of charge with a simulated phishing campaign within 24 hours, with no commitment.',
                ],
                'meta_description' => [
                    'fr' => 'Sensibilisation cybersécurité : simulations de phishing et formation contre l\'ingénierie sociale.',
                    'en' => 'Cybersecurity awareness: phishing simulations and training against social engineering.',
                ],
            ],
        ],
    ],
    [
        'slug' => 'capital-humain-perennisation',
        'sort_order' => 4,
        'icon' => 'heroicon-o-academic-cap',
        'featured_image' => 'services/service-4.jpg',
        'title' => [
            'fr' => 'Capital Humain & Pérennisation',
            'en' => 'Human Capital & Sustainability',
        ],
        'tagline' => [
            'fr' => 'La technologie ne vaut que par ceux qui l\'utilisent. Nous formons vos équipes pour qu\'elles deviennent autonomes et performantes.',
            'en' => 'Technology is only as good as the people who use it. We train your teams to become autonomous and high-performing.',
        ],
        'client_challenge' => [
            'fr' => 'Montée en compétences, adoption des outils',
            'en' => 'Skills development, tool adoption',
        ],
        'offer_summary' => [
            'fr' => 'Formation, habileté numérique, accompagnement',
            'en' => 'Training, digital literacy, support',
        ],
        'differentiator' => [
            'fr' => 'SkyITup ne vous abandonne pas après l\'installation. Nous vous accompagnons dans la pérennisation de vos investissements digitaux en formant vos équipes et vos partenaires, garantissant ainsi un retour sur investissement durable.',
            'en' => 'SkyITup does not leave you after installation. We support the sustainability of your digital investments by training your teams and partners, ensuring lasting return on investment.',
        ],
        'meta_description' => [
            'fr' => 'Pilier Capital Humain & Pérennisation : formation, habileté numérique et adoption des outils pour un ROI durable.',
            'en' => 'Human Capital & Sustainability pillar: training, digital literacy and tool adoption for lasting ROI.',
        ],
        'modules' => [
            [
                'slug' => 'habilete-numerique',
                'sort_order' => 1,
                'icon' => 'heroicon-o-computer-desktop',
                'cta_delay' => '48h',
                'featured_image' => null,
                'title' => [
                    'fr' => 'Programme « Habileté Numérique »',
                    'en' => 'Digital Literacy Program',
                ],
                'benefit_text' => [
                    'fr' => '<p>Transformez vos collaborateurs en acteurs agiles et créatifs du numérique en développant leur confiance, leur esprit critique et leur autonomie face aux outils digitaux, pour une adoption immédiate et durable sans résistance au changement.</p><p>Déjà suivi par 500 agents publics, notre programme « Habileté Numérique » réduit de 40&nbsp;% le temps d\'appropriation des nouveaux outils et augmente de 35&nbsp;% l\'autonomie déclarée des équipes en moins de 3 mois.</p>',
                    'en' => '<p>Turn your staff into agile, creative digital actors by building confidence, critical thinking and autonomy with digital tools—for immediate, lasting adoption without change resistance.</p><p>Already followed by 500 public sector agents, our Digital Literacy Program cuts new tool onboarding time by 40% and increases reported team autonomy by 35% in under 3 months.</p>',
                ],
                'summary_text' => [
                    'fr' => 'Aptitudes permettant une utilisation confiante, critique et créative du numérique.',
                    'en' => 'Skills enabling confident, critical and creative use of digital technology.',
                ],
                'cta_label' => [
                    'fr' => 'Profitez-en : évaluez gratuitement le niveau de maturité numérique de vos services sous 48h, sans engagement.',
                    'en' => 'Take advantage: assess your departments\' digital maturity free of charge within 48 hours, with no commitment.',
                ],
                'meta_description' => [
                    'fr' => 'Programme Habileté Numérique : développer la confiance et l\'autonomie digitale de vos équipes.',
                    'en' => 'Digital Literacy Program: build confidence and digital autonomy across your teams.',
                ],
            ],
            [
                'slug' => 'formation-collaborative-m365',
                'sort_order' => 2,
                'icon' => 'heroicon-o-video-camera',
                'cta_delay' => '72h',
                'featured_image' => null,
                'title' => [
                    'fr' => 'Formation aux outils collaboratifs (Microsoft 365, Teams, Outlook)',
                    'en' => 'Collaborative Tools Training (Microsoft 365, Teams, Outlook)',
                ],
                'benefit_text' => [
                    'fr' => '<p>Réduisez la surcharge de mails et les réunions inefficaces en maîtrisant pleinement l\'écosystème Microsoft 365 – Teams pour la visio, Outlook pour la messagerie, et Word/Excel/PowerPoint pour la co-édition en temps réel – où que se trouvent vos équipes.</p><p>Déjà adoptée par 120 directions, notre formation augmente de 45&nbsp;% la productivité collective et réduit de 30&nbsp;% le temps consacré aux réunions internes grâce à une gestion optimisée des espaces collaboratifs.</p>',
                    'en' => '<p>Reduce email overload and ineffective meetings by fully mastering the Microsoft 365 ecosystem—Teams for video, Outlook for mail, and Word/Excel/PowerPoint for real-time co-editing—wherever your teams are.</p><p>Already adopted by 120 departments, our training increases collective productivity by 45% and cuts time spent in internal meetings by 30% through optimized collaborative workspaces.</p>',
                ],
                'summary_text' => [
                    'fr' => 'Formation à Microsoft Outlook, Teams, Word, Excel, PowerPoint, etc.',
                    'en' => 'Training on Microsoft Outlook, Teams, Word, Excel, PowerPoint, etc.',
                ],
                'cta_label' => [
                    'fr' => 'Profitez-en : obtenez un diagnostic flash des usages collaboratifs actuels de votre entreprise sous 72h, sans engagement.',
                    'en' => 'Take advantage: get a quick assessment of your organization\'s current collaborative practices within 72 hours, with no commitment.',
                ],
                'meta_description' => [
                    'fr' => 'Formation Microsoft 365 : Teams, Outlook et co-édition pour booster la productivité collaborative.',
                    'en' => 'Microsoft 365 training: Teams, Outlook and co-editing to boost collaborative productivity.',
                ],
            ],
            [
                'slug' => 'formation-logiciels-metiers',
                'sort_order' => 3,
                'icon' => 'heroicon-o-cog-6-tooth',
                'cta_delay' => '48h',
                'featured_image' => null,
                'title' => [
                    'fr' => 'Formation aux logiciels métiers (ERP, paie) et progiciels métiers',
                    'en' => 'Business Software Training (ERP, Payroll & Line-of-Business Apps)',
                ],
                'benefit_text' => [
                    'fr' => '<p>Maximisez le retour sur investissement de vos ERP, paie et CRM en formant vos équipes à une maîtrise avancée : paramétrage métier, exploitation des rapports de gestion et automatisation des tâches récurrentes, pour des clôtures mensuelles sans stress et sans ressaisie.</p><p>Déjà déployée auprès de 80 responsables comptables et RH, notre approche réduit de 50&nbsp;% les erreurs de saisie et double la rapidité d\'exécution des clôtures financières.</p>',
                    'en' => '<p>Maximize ROI on your ERP, payroll and CRM by training teams to advanced mastery—business configuration, management reporting and automation of recurring tasks—for stress-free month-end closes with no re-entry.</p><p>Already deployed for 80 accounting and HR managers, our approach cuts data entry errors by 50% and doubles financial close speed.</p>',
                ],
                'summary_text' => [
                    'fr' => 'Formation aux progiciels de gestion intégrés.',
                    'en' => 'Training on integrated management software.',
                ],
                'cta_label' => [
                    'fr' => 'Profitez-en : faites auditer gratuitement le niveau de compétence réel de vos équipes sur vos progiciels sous 48h, sans engagement.',
                    'en' => 'Take advantage: have your teams\' actual skill level on your business software audited free of charge within 48 hours, with no commitment.',
                ],
                'meta_description' => [
                    'fr' => 'Formation ERP et progiciels métiers : maîtrise avancée pour clôtures sans erreur ni ressaisie.',
                    'en' => 'ERP and business software training: advanced mastery for error-free closes without re-entry.',
                ],
            ],
            [
                'slug' => 'sensibilisation-cybersecurite-formation',
                'sort_order' => 4,
                'icon' => 'heroicon-o-shield-exclamation',
                'cta_delay' => '24h',
                'featured_image' => null,
                'title' => [
                    'fr' => 'Sensibilisation à la cybersécurité',
                    'en' => 'Cybersecurity Awareness Training',
                ],
                'benefit_text' => [
                    'fr' => '<p>Faites de chaque collaborateur un rempart actif contre les cybermenaces en leur inculquant les réflexes essentiels face au phishing, aux usurpations d\'identité et aux arnaques, via des ateliers immersifs et des mises en situation réelles adaptés à vos métiers.</p><p>Déjà déployée dans 300 organisations, notre sensibilisation réduit de 70&nbsp;% les clics sur des liens malveillants et évite 80&nbsp;% des compromissions par ingénierie sociale en moins de 6 mois.</p>',
                    'en' => '<p>Make every employee an active barrier against cyber threats by instilling essential reflexes against phishing, identity theft and scams through immersive workshops and realistic scenarios tailored to your roles.</p><p>Already deployed in 300 organizations, our awareness program cuts clicks on malicious links by 70% and prevents 80% of social-engineering compromises in under 6 months.</p>',
                ],
                'summary_text' => [
                    'fr' => 'Former les agents aux bonnes pratiques pour éviter les arnaques et le phishing.',
                    'en' => 'Train staff in best practices to avoid scams and phishing.',
                ],
                'cta_label' => [
                    'fr' => 'Profitez-en : lancez gratuitement une campagne de phishing simulée auprès de 50 de vos collaborateurs sous 24h, sans engagement.',
                    'en' => 'Take advantage: launch a free simulated phishing campaign with 50 of your staff within 24 hours, with no commitment.',
                ],
                'meta_description' => [
                    'fr' => 'Sensibilisation cybersécurité en formation : ateliers immersifs contre phishing et ingénierie sociale.',
                    'en' => 'Cybersecurity awareness training: immersive workshops against phishing and social engineering.',
                ],
            ],
        ],
    ],
    [
        'slug' => 'infrastructure-modernisation',
        'sort_order' => 5,
        'icon' => 'heroicon-o-server-stack',
        'featured_image' => 'services/service-5.jpg',
        'title' => [
            'fr' => 'Infrastructure & Modernisation',
            'en' => 'Infrastructure & Modernization',
        ],
        'tagline' => [
            'fr' => 'Nous bâtissons des fondations technologiques robustes, évolutives et sécurisées.',
            'en' => 'We build robust, scalable and secure technology foundations.',
        ],
        'client_challenge' => [
            'fr' => 'Robustesse, mobilité, collaboration',
            'en' => 'Robustness, mobility, collaboration',
        ],
        'offer_summary' => [
            'fr' => 'Réseaux, équipements, outils collaboratifs (Microsoft 365)',
            'en' => 'Networks, equipment, collaborative tools (Microsoft 365)',
        ],
        'differentiator' => [
            'fr' => 'SkyITup vous offre une infrastructure clé en main, de l\'audit à la maintenance, en passant par l\'installation et la formation. Nous faisons le lien entre le matériel, les logiciels et les compétences humaines pour une transformation digitale cohérente et réussie.',
            'en' => 'SkyITup delivers turnkey infrastructure—from audit to maintenance, including installation and training. We connect hardware, software and human skills for a coherent, successful digital transformation.',
        ],
        'meta_description' => [
            'fr' => 'Pilier Infrastructure & Modernisation : réseaux, équipements IT et outils collaboratifs pour des fondations technologiques solides.',
            'en' => 'Infrastructure & Modernization pillar: networks, IT equipment and collaborative tools for solid technology foundations.',
        ],
        'modules' => [
            [
                'slug' => 'installation-infrastructure-it',
                'sort_order' => 1,
                'icon' => 'heroicon-o-server',
                'cta_delay' => '48h',
                'featured_image' => null,
                'title' => [
                    'fr' => 'Installation d\'infrastructures IT (sur site ou hébergé)',
                    'en' => 'IT Infrastructure Deployment (On-Premises or Hosted)',
                ],
                'benefit_text' => [
                    'fr' => '<p>Bâtissez un socle technique robuste et évolutif – sur site ou en hébergement sécurisé – parfaitement dimensionné à votre activité, à votre croissance prévisible et à vos contraintes budgétaires, sans surcapacité inutile ni sous-dimensionnement risqué.</p><p>Déjà déployée auprès de 80 organisations publiques et privées, notre approche garantit une disponibilité de 99,9&nbsp;% et réduit de 30&nbsp;% le coût total de possession (TCO) sur 3 ans.</p>',
                    'en' => '<p>Build a robust, scalable technical foundation—on-premises or in secure hosting—right-sized for your activity, expected growth and budget constraints, with no unnecessary overcapacity or risky under-sizing.</p><p>Already deployed for 80 public and private organizations, our approach guarantees 99.9% availability and reduces total cost of ownership (TCO) by 30% over 3 years.</p>',
                ],
                'summary_text' => [
                    'fr' => 'Installation de l\'infrastructure informatique minimum de votre choix (sur place ou hébergé).',
                    'en' => 'Deployment of your chosen minimum IT infrastructure (on-premises or hosted).',
                ],
                'cta_label' => [
                    'fr' => 'Profitez-en : recevez gratuitement un audit de dimensionnement de votre infrastructure actuelle sous 48h, sans engagement.',
                    'en' => 'Take advantage: receive a free sizing audit of your current infrastructure within 48 hours, with no commitment.',
                ],
                'meta_description' => [
                    'fr' => 'Installation d\'infrastructures IT sur site ou hébergées : dimensionnement optimal et haute disponibilité.',
                    'en' => 'On-premises or hosted IT infrastructure deployment: optimal sizing and high availability.',
                ],
            ],
            [
                'slug' => 'reseaux-connectivite',
                'sort_order' => 2,
                'icon' => 'heroicon-o-wifi',
                'cta_delay' => '72h',
                'featured_image' => null,
                'title' => [
                    'fr' => 'Réseaux et connectivité (Internet, LAN, WAN)',
                    'en' => 'Networks & Connectivity (Internet, LAN, WAN)',
                ],
                'benefit_text' => [
                    'fr' => '<p>Assurez la continuité de vos opérations avec une connectivité haut débit, redondante et ultra-réactive – architecture LAN/WAN optimisée, accès Internet sécurisé et basculement automatique – pour que vos équipes restent productives sans interruption, même en cas de pic de charge ou d\'incident local.</p><p>Déjà opérationnelle sur 150 sites, notre solution garantit un taux de disponibilité de 99,95&nbsp;% et des temps de latence inférieurs à 20&nbsp;ms pour vos applications critiques.</p>',
                    'en' => '<p>Ensure operational continuity with high-speed, redundant and highly responsive connectivity—optimized LAN/WAN architecture, secure Internet access and automatic failover—so teams stay productive without interruption, even during load spikes or local incidents.</p><p>Already operational across 150 sites, our solution guarantees 99.95% availability and latency under 20 ms for critical applications.</p>',
                ],
                'summary_text' => [
                    'fr' => 'Networking (Internet, réseaux informatiques).',
                    'en' => 'Networking (Internet, IT networks).',
                ],
                'cta_label' => [
                    'fr' => 'Profitez-en : faites tester gratuitement la performance de votre réseau actuel sous 72h, sans engagement.',
                    'en' => 'Take advantage: have your current network performance tested free of charge within 72 hours, with no commitment.',
                ],
                'meta_description' => [
                    'fr' => 'Réseaux et connectivité LAN/WAN : haut débit, redondance et basculement automatique.',
                    'en' => 'LAN/WAN networks and connectivity: high speed, redundancy and automatic failover.',
                ],
            ],
            [
                'slug' => 'outils-collaboratifs-mobilite',
                'sort_order' => 3,
                'icon' => 'heroicon-o-device-phone-mobile',
                'cta_delay' => '24h',
                'featured_image' => null,
                'title' => [
                    'fr' => 'Outils collaboratifs et mobilité',
                    'en' => 'Collaborative Tools & Mobility',
                ],
                'benefit_text' => [
                    'fr' => '<p>Libérez le potentiel de vos équipes en déployant un environnement collaboratif sécurisé et mobile – accès unifié, partage de fichiers, visioconférence, messagerie instantanée et authentification renforcée – qui garantit la continuité du travail à distance sans jamais compromettre la confidentialité de vos échanges.</p><p>Déjà adoptée par 200 organisations, notre solution augmente de 50&nbsp;% la réactivité des projets collaboratifs et certifie 100&nbsp;% des accès distants via une double authentification.</p>',
                    'en' => '<p>Unlock your teams\' potential by deploying a secure, mobile collaborative environment—unified access, file sharing, videoconferencing, instant messaging and strong authentication—ensuring remote work continuity without compromising confidentiality.</p><p>Already adopted by 200 organizations, our solution increases collaborative project responsiveness by 50% and secures 100% of remote access with two-factor authentication.</p>',
                ],
                'summary_text' => [
                    'fr' => 'Organisation sécurisée avec des outils collaboratifs et la mobilité.',
                    'en' => 'Secure organization with collaborative tools and mobility.',
                ],
                'cta_label' => [
                    'fr' => 'Profitez-en : obtenez une démo interactive de votre futur espace collaboratif sous 24h, sans engagement.',
                    'en' => 'Take advantage: get an interactive demo of your future collaborative workspace within 24 hours, with no commitment.',
                ],
                'meta_description' => [
                    'fr' => 'Outils collaboratifs et mobilité : travail à distance sécurisé avec authentification renforcée.',
                    'en' => 'Collaborative tools and mobility: secure remote work with strong authentication.',
                ],
            ],
            [
                'slug' => 'materiels-equipements',
                'sort_order' => 4,
                'icon' => 'heroicon-o-cpu-chip',
                'cta_delay' => '48h',
                'featured_image' => null,
                'title' => [
                    'fr' => 'Matériels et équipements',
                    'en' => 'Hardware & Equipment',
                ],
                'benefit_text' => [
                    'fr' => '<p>Équipez vos collaborateurs avec des matériels robustes, performants et parfaitement calibrés – postes de travail, serveurs, équipements réseau et périphériques – en fonction de vos usages métiers spécifiques, de vos contraintes budgétaires et de votre stratégie de renouvellement, avec un support technique intégré dès le premier jour.</p><p>Déjà déployé auprès de 1&nbsp;500 utilisateurs, notre parc de matériels affiche un taux de panne réduit de 40&nbsp;% et une durée de vie moyenne prolongée de 2 ans grâce à une sélection rigoureuse et une maintenance proactive.</p>',
                    'en' => '<p>Equip your staff with robust, high-performance hardware perfectly matched to your needs—workstations, servers, network equipment and peripherals—aligned with business use, budget constraints and renewal strategy, with integrated technical support from day one.</p><p>Already deployed for 1,500 users, our hardware fleet shows 40% fewer failures and an average lifespan extended by 2 years through rigorous selection and proactive maintenance.</p>',
                ],
                'summary_text' => [
                    'fr' => 'Matériels et équipements.',
                    'en' => 'Hardware and equipment.',
                ],
                'cta_label' => [
                    'fr' => 'Profitez-en : recevez une proposition d\'équipement personnalisée, chiffrée et comparative sous 48h, sans engagement.',
                    'en' => 'Take advantage: receive a personalized, priced and comparative equipment proposal within 48 hours, with no commitment.',
                ],
                'meta_description' => [
                    'fr' => 'Matériels et équipements IT : postes, serveurs et réseau dimensionnés à vos usages métiers.',
                    'en' => 'IT hardware and equipment: workstations, servers and network gear sized to your business needs.',
                ],
            ],
        ],
    ],
];
