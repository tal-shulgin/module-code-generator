<?php
/**
 * @author Igor Rain <igor.rain@icloud.com>
 * See LICENCE for license details.
 */

namespace IgorRain\CodeGenerator\Test\Unit\Model\Generator\Test;

use IgorRain\CodeGenerator\Model\Generator\Test\ModelRollbackIntegrationTestFixtureGenerator;
use IgorRain\CodeGenerator\Model\ResourceModel\Source\SourceFactory;
use IgorRain\CodeGenerator\Test\Unit\Model\Context\ModelContextTest;
use IgorRain\CodeGenerator\Test\Unit\Model\Generator\AbstractTextSourceGeneratorTest;

/**
 * @covers \IgorRain\CodeGenerator\Model\Generator\Test\ModelRollbackIntegrationTestFixtureGenerator
 */
class ModelRollbackIntegrationTestFixtureGeneratorTest extends AbstractTextSourceGeneratorTest
{
    protected function generate(SourceFactory $sourceFactory, string $fileName): void
    {
        $context = ModelContextTest::createContext();
        $generator = new ModelRollbackIntegrationTestFixtureGenerator($sourceFactory);
        $generator->generate($fileName, $context);
    }

    protected function getExpectedContent(): string
    {
        return '<?php

use Magento\Framework\Exception\NoSuchEntityException;
use Magento\TestFramework\Helper\Bootstrap;
use Vendor1\Module1Api\Api\Menu\ItemRepositoryInterface;

$objectManager = Bootstrap::getObjectManager();

try {
    /** @var ItemRepositoryInterface $menuItemRepository */
    $menuItemRepository = $objectManager->get(ItemRepositoryInterface::class);
    $menuItemRepository->deleteById(333);
} catch (NoSuchEntityException $exception) {
}
';
    }
}
