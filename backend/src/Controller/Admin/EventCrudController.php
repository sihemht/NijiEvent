<?php

namespace App\Controller\Admin;

use App\Entity\Event;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Workflow\Registry;
use EasyCorp\Bundle\EasyAdminBundle\Field\{DateField,NumberField,UrlField,TextField,TextEditorField,IdField};
use EasyCorp\Bundle\EasyAdminBundle\Config\{Url,Filters,Crud,Actions,Action};
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;


class EventCrudController extends AbstractCrudController
{

    public function __construct(private readonly Registry $registry){

    }
    public static function getEntityFqcn(): string
    {
        return Event::class;
    }

    public function configureFilters(Filters $filters): Filters{

        return $filters
        ->add('id')
        ->add('title')
        ->add('type')
        ->add('date_added')
        ->add('currentState')
        ;
    }

    public function configureActions(Actions $actions): Actions
    {
        $toReviewAction = Action::new('toReview', 'Review')
            ->linkToCrudAction('toReview')
            ->displayIf(function ($entity) {
                return $this->getCurrentState($entity) === 'draft';
            });

        $toPublishAction = Action::new('publish', 'Publish', 'fa fa-check')
            ->linkToCrudAction('publish')
            ->setCssClass('btn btn-success')
            ->displayIf(function ($entity) {
                return $this->getCurrentState($entity) === 'reviewed';
            });

        return $actions
            ->add(Crud::PAGE_INDEX, $toReviewAction)
            ->add(Crud::PAGE_INDEX, $toPublishAction);
    }
    private function getCurrentState(Event $event): string
    {
        $workflow = $this->registry->get($event, 'event_publishing');
        $marking = $workflow->getMarking($event);
        return key($marking->getPlaces());
    }

    public function toReview(Request $request,AdminContext $context, Registry $registry, EntityManagerInterface $entityManager): RedirectResponse
    {
        /** @var Event $event */
        $event = $context->getEntity()->getInstance();
        if ($this->getCurrentState($event, $registry) == 'reviewed') {
            return new RedirectResponse($request->headers->get('referer'));
        }

        $workflow = $registry->get($event, 'event_publishing');
        $workflow->apply($event, 'to_review');
        $entityManager->flush();

        return new RedirectResponse($request->headers->get('referer'));
    }

    public function publish(Request $request, AdminContext $context, Registry $registry, EntityManagerInterface $entityManager): RedirectResponse{
        /** @var Event $event */
        $event = $context->getEntity()->getInstance();
        $workflow = $registry->get($event, 'event_publishing');
        $workflow->apply($event, 'publish');
        $entityManager->flush();
        return new RedirectResponse($request->headers->get('referer'));
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            yield IdField::new('id')->setDisabled(),
            yield TextField::new('current_state')->setDisabled(),
            yield TextField::new('Title'),
            yield TextField::new('Type'),
            yield NumberField::new('speed'),
            yield NumberField::new('vote'),
            yield DateField::new('proposed_date'),
            yield UrlField::new('picture'),
            yield TextEditorField::new('description'),
        ];
    }
}
